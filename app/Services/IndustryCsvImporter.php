<?php

namespace App\Services;

use App\Models\BusinessUseCase;
use App\Models\Industry;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class IndustryCsvImporter
{
    public const BASIC_HEADERS = [
        'main_industry', 'sub_industry', 'detail',
    ];

    public const HEADERS = [
        'main_industry', 'main_slug', 'main_description', 'main_sort_order',
        'sub_industry', 'sub_slug', 'category', 'detail', 'highlights',
        'system_note', 'link_label', 'link_url', 'active', 'sub_sort_order',
    ];

    public function import(UploadedFile $file): int
    {
        $path = $file->getRealPath();
        if (! is_string($path) || $path === '' || ! is_file($path) || ! is_readable($path)) {
            throw ValidationException::withMessages(['import_file' => 'The CSV file could not be read.']);
        }

        $stream = fopen($path, 'rb');
        if ($stream === false) {
            throw ValidationException::withMessages(['import_file' => 'The CSV file could not be opened.']);
        }

        try {
            $sample = fread($stream, 65536);
            if (! is_string($sample) || trim($sample) === '') {
                throw ValidationException::withMessages(['import_file' => 'The CSV file is empty.']);
            }

            $encoding = $this->detectEncoding($sample);
            if ($encoding !== 'UTF-8') {
                fclose($stream);
                $stream = $this->openUtf8Stream($path, $encoding);
            } else {
                rewind($stream);
            }

            $firstLine = fgets($stream);
            if (! is_string($firstLine)) {
                throw ValidationException::withMessages(['import_file' => 'The CSV file is empty.']);
            }
            $delimiter = $this->detectDelimiter($firstLine);
            rewind($stream);

            $headers = fgetcsv($stream, null, $delimiter, '"', '');
            if (! is_array($headers)) {
                throw ValidationException::withMessages(['import_file' => 'The CSV file is empty.']);
            }

            $headers = $this->normaliseHeaders($headers);
            if ($headers !== self::BASIC_HEADERS && $headers !== self::HEADERS) {
                throw ValidationException::withMessages([
                    'import_file' => 'Use either the basic headings (main_industry, sub_industry, detail) or download the full CSV template and keep its column order.',
                ]);
            }

            $count = 0;
            $line = 1;

            DB::beginTransaction();
            try {
                while (($values = fgetcsv($stream, null, $delimiter, '"', '')) !== false) {
                    $line++;

                    if (count(array_filter($values, fn (mixed $value): bool => trim((string) $value) !== '')) === 0) {
                        continue;
                    }

                    if (count($values) !== count($headers)) {
                        throw ValidationException::withMessages(['import_file' => "Row {$line} has the wrong number of columns."]);
                    }

                    $importedRow = array_combine(
                        $headers,
                        array_map(fn (mixed $value): string => trim((string) $value), $values),
                    );
                    $row = array_replace(array_fill_keys(self::HEADERS, ''), $importedRow);

                    $validator = Validator::make($row, [
                        'main_industry' => ['required', 'string', 'max:180'],
                        'main_slug' => ['nullable', 'alpha_dash', 'max:180'],
                        'main_description' => ['nullable', 'string', 'max:5000'],
                        'main_sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
                        'sub_industry' => ['required', 'string', 'max:180'],
                        'sub_slug' => ['nullable', 'alpha_dash', 'max:180'],
                        'category' => ['nullable', 'string', 'max:120'],
                        'detail' => ['required', 'string', 'max:12000'],
                        'highlights' => ['nullable', 'string', 'max:3500'],
                        'system_note' => ['nullable', 'string', 'max:2500'],
                        'link_label' => ['nullable', 'string', 'max:120'],
                        'link_url' => ['nullable', 'string', 'max:1000', 'regex:#^(?:/|https?://)#i'],
                        'active' => ['nullable', 'in:0,1,true,false,yes,no'],
                        'sub_sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
                    ]);

                    if ($validator->fails()) {
                        throw ValidationException::withMessages(['import_file' => "Row {$line}: ".$validator->errors()->first()]);
                    }

                    $this->persistRow($row);
                    $count++;
                }

                if ($count === 0) {
                    throw ValidationException::withMessages(['import_file' => 'Add at least one data row to the CSV file.']);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }

            return $count;
        } finally {
            if (is_resource($stream)) {
                fclose($stream);
            }
        }
    }

    private function detectDelimiter(string $firstLine): string
    {
        foreach ([',', "\t", ';'] as $delimiter) {
            $headers = str_getcsv($firstLine, $delimiter, '"', '');
            $headers = $this->normaliseHeaders($headers);

            if ($headers === self::BASIC_HEADERS || $headers === self::HEADERS) {
                return $delimiter;
            }
        }

        throw ValidationException::withMessages([
            'import_file' => 'The file headings could not be recognised. Use the basic headings (main_industry, sub_industry, detail) or the downloaded template. Comma, tab and semicolon separated CSV files are supported.',
        ]);
    }

    /** @param array<int, mixed> $headers
     *  @return array<int, string>
     */
    private function normaliseHeaders(array $headers): array
    {
        return array_map(
            fn (mixed $header): string => Str::of((string) $header)
                ->replace("\xEF\xBB\xBF", '')
                ->trim()
                ->lower()
                ->toString(),
            $headers,
        );
    }

    private function detectEncoding(string $sample): string
    {
        if (str_starts_with($sample, "\xFF\xFE")) {
            return 'UTF-16LE';
        }
        if (str_starts_with($sample, "\xFE\xFF")) {
            return 'UTF-16BE';
        }
        if (str_starts_with($sample, "\xEF\xBB\xBF")) {
            return 'UTF-8';
        }
        if (preg_match('//u', $sample) === 1) {
            return 'UTF-8';
        }

        return 'Windows-1252';
    }

    /** @return resource */
    private function openUtf8Stream(string $path, string $encoding): mixed
    {
        $stream = fopen($path, 'rb');
        if ($stream === false) {
            throw ValidationException::withMessages(['import_file' => 'The CSV file could not be opened.']);
        }

        // Remove UTF-16 BOM bytes before attaching the conversion filter.
        if (in_array($encoding, ['UTF-16LE', 'UTF-16BE'], true)) {
            fread($stream, 2);
        }

        $filter = @stream_filter_append($stream, 'convert.iconv.'.$encoding.'/UTF-8');
        if ($filter === false) {
            fclose($stream);
            throw ValidationException::withMessages([
                'import_file' => 'The CSV text encoding is not supported on this server. Save the file as UTF-8 CSV and try again.',
            ]);
        }

        return $stream;
    }

    /** @param array<string, string> $row */
    private function persistRow(array $row): void
    {
        // Normalise visible names before matching so harmless differences such as
        // casing or repeated spaces do not create duplicate database records.
        $mainName = $this->normaliseLabel($row['main_industry']);
        $subTitle = $this->normaliseLabel($row['sub_industry']);
        $requestedMainSlug = Str::slug($row['main_slug'] ?: $mainName);

        $industry = Industry::query()
            ->where(function ($query) use ($mainName, $requestedMainSlug): void {
                $query->whereRaw('LOWER(TRIM(name)) = ?', [Str::lower($mainName)]);
                if ($requestedMainSlug !== '') {
                    $query->orWhere('slug', $requestedMainSlug);
                }
            })
            ->orderBy('id')
            ->first();

        if (! $industry) {
            $industry = new Industry();
            $industry->name = $mainName;
            $industry->slug = $this->uniqueIndustrySlug($row['main_slug'] ?: $mainName);
        } else {
            // Keep one canonical display value while updating the matched record.
            $industry->name = $mainName;
        }

        $industry->fill([
            'description' => $row['main_description'] ?: $industry->description,
            'is_active' => $this->toBoolean($row['active']),
            'sort_order' => $row['main_sort_order'] !== '' ? (int) $row['main_sort_order'] : ($industry->sort_order ?: 0),
        ])->save();

        $requestedSubSlug = Str::slug($row['sub_slug'] ?: $industry->name.' '.$subTitle);
        $subIndustry = BusinessUseCase::query()
            ->where('industry_id', $industry->getKey())
            ->where(function ($query) use ($subTitle, $requestedSubSlug): void {
                $query->whereRaw('LOWER(TRIM(title)) = ?', [Str::lower($subTitle)]);
                if ($requestedSubSlug !== '') {
                    $query->orWhere('slug', $requestedSubSlug);
                }
            })
            ->orderBy('id')
            ->first();

        if (! $subIndustry) {
            $subIndustry = new BusinessUseCase();
            $subIndustry->industry_id = $industry->getKey();
            $subIndustry->title = $subTitle;
            $subIndustry->slug = $this->uniqueSubIndustrySlug($row['sub_slug'] ?: $industry->name.' '.$subTitle);
        } else {
            $subIndustry->title = $subTitle;
        }

        $subIndustry->fill([
            'category' => $row['category'] ?: null,
            'description' => $row['detail'],
            'highlights' => collect(explode('|', $row['highlights']))
                ->map(fn (string $highlight): string => trim($highlight))
                ->filter()
                ->values()
                ->all(),
            'system_note' => $row['system_note'] ?: null,
            'link_label' => $row['link_label'] ?: null,
            'link_url' => $row['link_url'] ?: null,
            'is_active' => $this->toBoolean($row['active']),
            'sort_order' => $row['sub_sort_order'] !== '' ? (int) $row['sub_sort_order'] : ($subIndustry->sort_order ?: 0),
            'media_type' => $subIndustry->media_type ?: 'image',
        ])->save();
    }

    private function normaliseLabel(string $value): string
    {
        $value = trim($value);
        $normalised = preg_replace('/\s+/u', ' ', $value);

        return is_string($normalised) ? $normalised : $value;
    }

    private function uniqueIndustrySlug(string $value): string
    {
        return $this->uniqueSlug($value, fn (string $slug): bool => Industry::query()->where('slug', $slug)->exists());
    }

    private function uniqueSubIndustrySlug(string $value): string
    {
        return $this->uniqueSlug($value, fn (string $slug): bool => BusinessUseCase::query()->where('slug', $slug)->exists());
    }

    private function uniqueSlug(string $value, callable $exists): string
    {
        $base = Str::slug($value) ?: 'industry';
        $slug = $base;
        $suffix = 2;

        while ($exists($slug)) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    private function toBoolean(string $value): bool
    {
        return ! in_array(Str::lower($value), ['0', 'false', 'no'], true);
    }
}
