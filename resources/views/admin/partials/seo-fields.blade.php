@php
    $seoModel = $seoModel ?? null;
    $seoTitleValue = old('seo_title', $seoModel?->seo_title);
    $seoKeywordsValue = old('meta_keywords', $seoModel?->meta_keywords);
    $seoDescriptionValue = old('meta_description', $seoModel?->meta_description);
@endphp

<section class="rounded-2xl border border-white/10 bg-white/[0.025] p-5 sm:p-6">
    <div>
        <p class="neutron-kicker">SEO</p>
        <h3 class="mt-2 text-lg font-medium text-white">Search engine metadata</h3>
        <p class="mt-2 max-w-2xl text-xs leading-5 text-white/35">Set the page title, comma-separated keywords and search description. The description uses CKEditor in admin; HTML is stripped automatically when output in the page &lt;meta&gt; tag.</p>
    </div>

    <div class="mt-5 grid gap-5 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="seo_title" value="SEO title" />
            <x-text-input id="seo_title" name="seo_title" class="mt-2 block w-full" :value="$seoTitleValue" maxlength="70" placeholder="A1 Legacy Labs — AI Automation" />
            <p class="mt-2 text-xs text-white/30">Recommended: up to 60–70 characters.</p>
            <x-input-error class="mt-2" :messages="$errors->get('seo_title')" />
        </div>

        <div class="sm:col-span-2">
            <x-input-label for="meta_keywords" value="SEO keywords" />
            <x-text-input id="meta_keywords" name="meta_keywords" class="mt-2 block w-full" :value="$seoKeywordsValue" maxlength="500" placeholder="voice AI, AI receptionist, CRM automation" />
            <p class="mt-2 text-xs text-white/30">Use a short, relevant comma-separated list. This field is editable per page/content item.</p>
            <x-input-error class="mt-2" :messages="$errors->get('meta_keywords')" />
        </div>

        <div class="sm:col-span-2">
            <x-input-label for="meta_description" value="SEO description (CKEditor)" />
            <textarea id="meta_description" name="meta_description" rows="6" data-rich-editor class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ $seoDescriptionValue }}</textarea>
            <p class="mt-2 text-xs text-white/30">Keep the visible text concise and specific. Formatting is available in admin, while the public meta description is output as plain text.</p>
            <x-input-error class="mt-2" :messages="$errors->get('meta_description')" />
        </div>
    </div>
</section>
