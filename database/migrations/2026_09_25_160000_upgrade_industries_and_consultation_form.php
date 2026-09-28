<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('business_use_cases') && ! Schema::hasColumn('business_use_cases', 'slug')) {
            Schema::table('business_use_cases', function (Blueprint $table): void {
                $table->string('slug')->nullable()->after('category');
                $table->unique('slug', 'business_use_cases_slug_unique');
            });

            DB::table('business_use_cases')->orderBy('id')->get(['id', 'title'])->each(function ($row): void {
                $base = Str::slug((string) $row->title) ?: 'industry-'.$row->id;
                $slug = $base;
                $suffix = 2;

                while (DB::table('business_use_cases')->where('slug', $slug)->exists()) {
                    $slug = $base.'-'.$suffix;
                    $suffix++;
                }

                DB::table('business_use_cases')->where('id', $row->id)->update(['slug' => $slug]);
            });
        }

        if (Schema::hasTable('contact_messages')) {
            $columns = [
                'first_name' => fn (Blueprint $table) => $table->string('first_name', 120)->nullable()->after('name'),
                'last_name' => fn (Blueprint $table) => $table->string('last_name', 120)->nullable()->after('first_name'),
                'website_url' => fn (Blueprint $table) => $table->string('website_url', 500)->nullable()->after('phone'),
                'role' => fn (Blueprint $table) => $table->string('role', 160)->nullable()->after('website_url'),
                'role_other' => fn (Blueprint $table) => $table->string('role_other', 160)->nullable()->after('role'),
                'decision_maker' => fn (Blueprint $table) => $table->string('decision_maker', 30)->nullable()->after('role_other'),
                'country' => fn (Blueprint $table) => $table->string('country', 120)->nullable()->after('decision_maker'),
                'country_other' => fn (Blueprint $table) => $table->string('country_other', 120)->nullable()->after('country'),
                'industry' => fn (Blueprint $table) => $table->string('industry', 160)->nullable()->after('country_other'),
                'industry_other' => fn (Blueprint $table) => $table->string('industry_other', 160)->nullable()->after('industry'),
                'company_size' => fn (Blueprint $table) => $table->string('company_size', 60)->nullable()->after('industry_other'),
                'annual_turnover' => fn (Blueprint $table) => $table->string('annual_turnover', 80)->nullable()->after('company_size'),
                'monthly_leads' => fn (Blueprint $table) => $table->string('monthly_leads', 80)->nullable()->after('annual_turnover'),
                'current_crm' => fn (Blueprint $table) => $table->string('current_crm', 160)->nullable()->after('monthly_leads'),
                'current_crm_other' => fn (Blueprint $table) => $table->string('current_crm_other', 160)->nullable()->after('current_crm'),
                'service_interest' => fn (Blueprint $table) => $table->string('service_interest', 190)->nullable()->after('current_crm_other'),
                'service_interest_other' => fn (Blueprint $table) => $table->string('service_interest_other', 190)->nullable()->after('service_interest'),
                'business_challenge' => fn (Blueprint $table) => $table->string('business_challenge', 190)->nullable()->after('service_interest_other'),
                'business_challenge_other' => fn (Blueprint $table) => $table->string('business_challenge_other', 190)->nullable()->after('business_challenge'),
                'preferred_contact_method' => fn (Blueprint $table) => $table->string('preferred_contact_method', 60)->nullable()->after('business_challenge_other'),
                'preferred_time_zone' => fn (Blueprint $table) => $table->string('preferred_time_zone', 120)->nullable()->after('preferred_contact_method'),
                'preferred_time_zone_other' => fn (Blueprint $table) => $table->string('preferred_time_zone_other', 160)->nullable()->after('preferred_time_zone'),
                'project_timeline' => fn (Blueprint $table) => $table->string('project_timeline', 80)->nullable()->after('preferred_time_zone_other'),
                'contact_consent' => fn (Blueprint $table) => $table->boolean('contact_consent')->default(false)->after('message'),
            ];

            foreach ($columns as $name => $definition) {
                if (! Schema::hasColumn('contact_messages', $name)) {
                    Schema::table('contact_messages', fn (Blueprint $table) => $definition($table));
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('contact_messages')) {
            $drop = collect([
                'first_name', 'last_name', 'website_url', 'role', 'role_other', 'decision_maker',
                'country', 'country_other', 'industry', 'industry_other', 'company_size', 'annual_turnover',
                'monthly_leads', 'current_crm', 'current_crm_other', 'service_interest', 'service_interest_other',
                'business_challenge', 'business_challenge_other', 'preferred_contact_method', 'preferred_time_zone',
                'preferred_time_zone_other', 'project_timeline', 'contact_consent',
            ])->filter(fn (string $column) => Schema::hasColumn('contact_messages', $column))->values()->all();

            if ($drop !== []) {
                Schema::table('contact_messages', fn (Blueprint $table) => $table->dropColumn($drop));
            }
        }

        if (Schema::hasTable('business_use_cases') && Schema::hasColumn('business_use_cases', 'slug')) {
            Schema::table('business_use_cases', function (Blueprint $table): void {
                $table->dropUnique('business_use_cases_slug_unique');
                $table->dropColumn('slug');
            });
        }
    }
};
