<?php

namespace Database\Seeders;

use App\Models\BusinessUseCase;
use App\Models\Industry;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BusinessUseCaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('business_use_cases')) {
            return;
        }

        $home = Schema::hasTable('pages')
            ? Page::query()->where('slug', 'home')->first()
            : null;

        $legacySection = null;
        if ($home && Schema::hasTable('page_sections') && Schema::hasTable('section_items')) {
            $legacySection = PageSection::query()
                ->where('page_id', $home->id)
                ->where('key', '!=', 'business-fit')
                ->where(function ($query): void {
                    $query->whereRaw('LOWER(heading) = ?', ['see exactly where ai fits'])
                        ->orWhereRaw('LOWER(eyebrow) = ?', ['built around your business']);
                })
                ->with(['items' => fn ($items) => $items->orderBy('sort_order')->orderBy('id')])
                ->first();
        }

        if (BusinessUseCase::query()->doesntExist()) {
            if ($legacySection && $legacySection->items->isNotEmpty()) {
                foreach ($legacySection->items as $item) {
                    BusinessUseCase::query()->create([
                        'category' => $item->subtitle ?: $item->badge,
                        'title' => $item->title,
                        'description' => $item->description,
                        'image_url' => $item->image_url,
                        'highlights' => collect(data_get($item->settings, 'highlights', []))->filter()->values()->all(),
                        'system_note' => data_get($item->settings, 'system_note'),
                        'link_label' => $item->link_label,
                        'link_url' => $item->link_url,
                        'is_active' => $item->is_enabled,
                        'sort_order' => $item->sort_order,
                    ]);
                }
            } else {
                foreach ($this->defaults() as $item) {
                    BusinessUseCase::query()->create($item + ['is_active' => true]);
                }
            }
        }

        if (Schema::hasColumn('business_use_cases', 'slug')) {
            BusinessUseCase::query()->orderBy('id')->get()->each(function (BusinessUseCase $industry): void {
                if ($industry->slug) {
                    return;
                }
                $base = Str::slug($industry->title) ?: 'industry-'.$industry->id;
                $slug = $base;
                $suffix = 2;
                while (BusinessUseCase::query()->where('slug', $slug)->where('id', '!=', $industry->getKey())->exists()) {
                    $slug = $base.'-'.$suffix++;
                }
                $industry->update(['slug' => $slug]);
            });
        }

        if (Schema::hasTable('industries') && Schema::hasColumn('business_use_cases', 'industry_id')) {
            BusinessUseCase::query()
                ->whereNull('industry_id')
                ->orderBy('id')
                ->get()
                ->each(function (BusinessUseCase $subIndustry): void {
                    $base = Str::slug($subIndustry->title) ?: 'industry-'.$subIndustry->getKey();
                    $slug = $base;
                    $suffix = 2;
                    while (Industry::query()->where('slug', $slug)->exists()) {
                        $slug = $base.'-'.$suffix;
                        $suffix++;
                    }

                    $industry = Industry::query()->create([
                        'name' => $subIndustry->title,
                        'slug' => $slug,
                        'description' => $subIndustry->description,
                        'is_active' => $subIndustry->is_active,
                        'sort_order' => $subIndustry->sort_order,
                    ]);

                    $subIndustry->update(['industry_id' => $industry->getKey()]);
                });
        }

        if ($home && Schema::hasTable('page_sections')) {
            $existing = PageSection::query()
                ->where('page_id', $home->id)
                ->where('key', 'business-fit')
                ->first();

            $payload = [
                'type' => 'business_showcase',
                'eyebrow' => 'Industries',
                'heading' => 'See where AI fits in your industry',
                'body' => 'Choose an industry to explore practical customer operations, lead handling and automation opportunities, then open the full industry page for more detail.',
                'is_enabled' => true,
                'sort_order' => $legacySection?->sort_order ?? $existing?->sort_order ?? 3,
            ];

            if ($existing) {
                $existing->update($payload);
                $section = $existing->fresh();
            } else {
                $section = PageSection::query()->create($payload + ['page_id' => $home->id, 'key' => 'business-fit']);
            }

            if ($legacySection) {
                $legacySection->update(['is_enabled' => false]);
            }

            PageSection::query()
                ->where('page_id', $home->id)
                ->where('id', '!=', $section->id)
                ->whereRaw('LOWER(heading) = ?', ['see exactly where ai fits'])
                ->update(['is_enabled' => false]);
        }
    }

    private function defaults(): array
    {
        return [
            [
                'category' => 'Agencies & Brokerages',
                'slug' => 'insurance',
                'title' => 'Insurance',
                'description' => 'Respond faster, qualify consistently and reduce repetitive producer and service-team admin.',
                'highlights' => ['Capture and qualify new enquiries', 'Route renewals and service requests', 'Book adviser calls and follow-up tasks'],
                'system_note' => 'Designed to work around approved CRM, calendar, phone and messaging systems without forcing a rip-and-replace.',
                'sort_order' => 10,
            ],
            [
                'category' => 'Home Services',
                'slug' => 'home-services',
                'title' => 'Home Services',
                'description' => 'Turn missed calls and website enquiries into structured bookings, tasks and follow-up for field teams.',
                'highlights' => ['24/7 enquiry capture', 'Booking and rescheduling workflows', 'Urgent-call escalation to a human'],
                'system_note' => 'Connect the AI layer to your existing booking, dispatch, CRM and notification workflow.',
                'sort_order' => 20,
            ],
            [
                'category' => 'Property & Real Estate',
                'slug' => 'real-estate',
                'title' => 'Real Estate',
                'description' => 'Keep buyer, seller, valuation and property-management enquiries moving with consistent qualification and routing.',
                'highlights' => ['Property enquiry qualification', 'Viewing and valuation scheduling', 'CRM handoff with conversation context'],
                'system_note' => 'Use your existing property, CRM and calendar systems as the source of truth while A1 Legacy coordinates the customer journey.',
                'sort_order' => 30,
            ],
            [
                'category' => 'Professional Services',
                'slug' => 'professional-services',
                'title' => 'Professional Services',
                'description' => 'Give prospects a useful first response, collect the right context and route each enquiry to the right next step.',
                'highlights' => ['Discovery-call qualification', 'Lead routing by service and urgency', 'Automated reminders and follow-up'],
                'system_note' => 'Suitable for consulting, finance, recruitment and other service firms with approved intake and escalation rules.',
                'sort_order' => 40,
            ],
        ];
    }
}
