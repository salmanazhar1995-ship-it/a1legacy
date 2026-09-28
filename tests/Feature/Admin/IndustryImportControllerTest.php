<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Services\IndustryCsvImporter;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class IndustryImportControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_import_main_sub_and_detail_data_from_csv(): void
    {
        $admin = User::factory()->admin()->create();
        $csv = $this->csv([
            'Insurance', 'insurance', 'Insurance workflows', '10',
            'Claims Operations', 'claims-operations', 'Agencies & Brokerages',
            'Automate claims intake and routing.', 'Claims intake|Customer updates',
            'Works with the approved CRM.', 'Explore', '/industries/claims-operations', '1', '20',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.industries.import'), [
            'import_file' => UploadedFile::fake()->createWithContent('industries.csv', $csv),
        ]);

        $response->assertRedirect(route('admin.industries.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('industries', ['name' => 'Insurance', 'slug' => 'insurance', 'sort_order' => 10]);
        $this->assertDatabaseHas('business_use_cases', [
            'title' => 'Claims Operations',
            'slug' => 'claims-operations',
            'description' => 'Automate claims intake and routing.',
            'sort_order' => 20,
        ]);
    }

    public function test_admin_can_import_the_basic_three_column_csv_format(): void
    {
        $admin = User::factory()->admin()->create();
        $csv = "main_industry,sub_industry,detail\nInsurance,Claims Operations,Automate claims intake and routing.";

        $response = $this->actingAs($admin)->post(route('admin.industries.import'), [
            'import_file' => UploadedFile::fake()->createWithContent('industries.csv', $csv),
        ]);

        $response->assertRedirect(route('admin.industries.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('industries', [
            'name' => 'Insurance',
            'slug' => 'insurance',
        ]);
        $this->assertDatabaseHas('business_use_cases', [
            'title' => 'Claims Operations',
            'slug' => 'insurance-claims-operations',
            'description' => 'Automate claims intake and routing.',
        ]);
    }

    public function test_admin_can_import_excel_tab_separated_csv_with_windows_1252_text(): void
    {
        $admin = User::factory()->admin()->create();
        $utf8 = "main_industry\tsub_industry\tdetail\r\nHospitality\tCafé Operations\t\"Capture enquiries, bookings and café follow-up.\"";
        $content = iconv('UTF-8', 'Windows-1252//TRANSLIT', $utf8);

        $response = $this->actingAs($admin)->post(route('admin.industries.import'), [
            'import_file' => UploadedFile::fake()->createWithContent('industries.csv', $content ?: $utf8),
        ]);

        $response->assertRedirect(route('admin.industries.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('industries', ['name' => 'Hospitality']);
        $this->assertDatabaseHas('business_use_cases', [
            'title' => 'Café Operations',
            'description' => 'Capture enquiries, bookings and café follow-up.',
        ]);
    }

    public function test_more_than_one_thousand_data_rows_are_rejected(): void
    {
        $admin = User::factory()->admin()->create();
        $rows = ["main_industry,sub_industry,detail"];

        for ($i = 1; $i <= 1001; $i++) {
            $rows[] = "Industry {$i},Sub Industry {$i},Detail {$i}";
        }

        $response = $this->actingAs($admin)->post(route('admin.industries.import'), [
            'import_file' => UploadedFile::fake()->createWithContent('industries.csv', implode("\n", $rows)),
        ]);

        $response->assertSessionHasErrors('import_file');
        $this->assertDatabaseCount('industries', 0);
        $this->assertDatabaseCount('business_use_cases', 0);
    }

    public function test_invalid_csv_headings_are_rejected_without_saving_rows(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.industries.import'), [
            'import_file' => UploadedFile::fake()->createWithContent('industries.csv', "wrong,headings\nInsurance,Claims"),
        ]);

        $response->assertSessionHasErrors('import_file');
        $this->assertDatabaseCount('industries', 0);
        $this->assertDatabaseCount('business_use_cases', 0);
    }

    /** @param array<int, string> $row */
    private function csv(array $row): string
    {
        $stream = fopen('php://temp', 'w+b');
        fputcsv($stream, IndustryCsvImporter::HEADERS);
        fputcsv($stream, $row);
        rewind($stream);
        $csv = stream_get_contents($stream);
        fclose($stream);

        return $csv;
    }
}
