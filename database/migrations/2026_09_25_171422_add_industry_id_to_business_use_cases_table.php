<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('business_use_cases', function (Blueprint $table): void {
            $table->foreignId('industry_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->restrictOnDelete();
        });

        DB::table('business_use_cases')->orderBy('id')->get()->each(function (object $subIndustry): void {
            $name = trim((string) $subIndustry->title);
            $baseSlug = Str::slug($name) ?: 'industry-'.$subIndustry->id;
            $slug = $baseSlug;
            $suffix = 2;

            while (DB::table('industries')->where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$suffix;
                $suffix++;
            }

            $industryId = DB::table('industries')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'description' => $subIndustry->description,
                'is_active' => $subIndustry->is_active,
                'sort_order' => $subIndustry->sort_order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('business_use_cases')->where('id', $subIndustry->id)->update(['industry_id' => $industryId]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_use_cases', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('industry_id');
        });
    }
};
