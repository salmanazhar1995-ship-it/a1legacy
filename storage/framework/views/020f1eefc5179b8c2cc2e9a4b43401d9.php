
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://unpkg.com/filepond@4/dist/filepond.min.css">
<link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.css">

<style>
    .dt-container { color: rgba(255,255,255,.78); }
    .dt-container .dt-search input,
    .dt-container .dt-length select {
        border: 1px solid rgba(255,255,255,.10) !important;
        background: rgba(255,255,255,.04) !important;
        color: #fff !important;
        border-radius: .65rem !important;
        padding: .55rem .7rem !important;
    }
    .dt-container .dt-search input { min-width: 220px; }
    .dt-container .dt-paging .dt-paging-button {
        border: 1px solid rgba(255,255,255,.08) !important;
        background: rgba(255,255,255,.025) !important;
        color: rgba(255,255,255,.62) !important;
        border-radius: .55rem !important;
    }
    .dt-container .dt-paging .dt-paging-button.current,
    .dt-container .dt-paging .dt-paging-button:hover {
        background: rgba(47,143,255,.15) !important;
        color: #fff !important;
        border-color: rgba(158,203,255,.22) !important;
    }
    table.dataTable > thead > tr > th,
    table.dataTable > thead > tr > td { border-bottom: 1px solid rgba(255,255,255,.08) !important; }
    table.dataTable > tbody > tr { background: transparent !important; }
    table.dataTable > tbody > tr > td { border-top: 1px solid rgba(255,255,255,.06) !important; }
    .filepond--root { margin-top: .75rem; }
    .filepond--panel-root { background: rgba(255,255,255,.035); border: 1px solid rgba(255,255,255,.10); }
    .filepond--drop-label { color: rgba(255,255,255,.58); }
    .filepond--label-action { color: #9ecbff; }
    .filepond--item-panel { background: #0A2540; }
    textarea {
        background: #06111d !important;
        color: #eaf4ff !important;
        border-color: rgba(255, 255, 255, .12) !important;
        caret-color: #eaf4ff;
    }
    textarea::placeholder { color: rgba(234, 244, 255, .42); }
    .ck.ck-editor {
        --ck-color-base-background: #06111d;
        --ck-color-base-foreground: #0a1725;
        --ck-color-base-border: rgba(255, 255, 255, .12);
        --ck-color-base-text: #eaf4ff;
        --ck-color-toolbar-background: #0a1725;
        --ck-color-toolbar-border: rgba(255, 255, 255, .12);
        --ck-color-panel-background: #0a1725;
        --ck-color-panel-border: rgba(255, 255, 255, .12);
        --ck-color-list-background: #0a1725;
        --ck-color-button-default-background: transparent;
        --ck-color-button-default-hover-background: rgba(47, 143, 255, .16);
        --ck-color-button-default-active-background: rgba(47, 143, 255, .22);
        --ck-color-button-on-background: rgba(47, 143, 255, .22);
        --ck-color-button-on-color: #fff;
        --ck-color-focus-border: #2f8fff;
        --ck-color-input-background: #06111d;
        --ck-color-input-border: rgba(255, 255, 255, .12);
        --ck-color-input-text: #eaf4ff;
    }
    .ck.ck-editor__main > .ck-editor__editable,
    .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
        min-height: 220px;
        background: #06111d !important;
        color: #eaf4ff !important;
        border-color: rgba(255, 255, 255, .12) !important;
        caret-color: #eaf4ff;
    }
    .ck.ck-editor__main > .ck-editor__editable.ck-focused {
        border-color: rgba(47, 143, 255, .65) !important;
    }
    .ck.ck-editor__editable p,
    .ck.ck-editor__editable h2,
    .ck.ck-editor__editable h3,
    .ck.ck-editor__editable h4,
    .ck.ck-editor__editable li { color: #eaf4ff; }
    .ck.ck-toolbar,
    .ck.ck-toolbar.ck-toolbar_grouping {
        background: #0a1725 !important;
        border-color: rgba(255, 255, 255, .12) !important;
    }
    .ck.ck-button,
    .ck.ck-button.ck-off { color: rgba(234, 244, 255, .75) !important; }
    .ck.ck-button:hover,
    .ck.ck-button.ck-on {
        background: rgba(47, 143, 255, .16) !important;
        color: #fff !important;
    }
    .ck.ck-dropdown__panel,
    .ck.ck-balloon-panel,
    .ck.ck-list,
    .ck.ck-list__item,
    .ck.ck-input-text {
        background: #0a1725 !important;
        color: #eaf4ff !important;
        border-color: rgba(255, 255, 255, .12) !important;
    }
    .ck.ck-editor__editable table td,
    .ck.ck-editor__editable table th {
        background: #06111d !important;
        color: #eaf4ff !important;
        border-color: rgba(255, 255, 255, .16) !important;
    }
    .a1-admin-empty { border: 1px dashed rgba(255,255,255,.10); border-radius: 1rem; padding: 2.5rem; text-align: center; color: rgba(255,255,255,.38); }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size@2/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond@4/dist/filepond.min.js"></script>

<script>
(function () {
    'use strict';

    function initTables() {
        if (!window.jQuery || !jQuery.fn.DataTable) return;

        document.querySelectorAll('table.js-yajra-table').forEach(function (table) {
            if (table.dataset.ready === '1') return;
            table.dataset.ready = '1';

            const columns = Array.from(table.querySelectorAll('thead th')).map(function (th) {
                return {
                    data: th.dataset.data,
                    name: th.dataset.name || th.dataset.data,
                    orderable: th.dataset.orderable !== 'false',
                    searchable: th.dataset.searchable !== 'false',
                    className: th.dataset.class || ''
                };
            });

            jQuery(table).DataTable({
                processing: true,
                serverSide: true,
                ajax: table.dataset.url,
                columns: columns,
                pageLength: Number(table.dataset.pageLength || 20),
                order: table.dataset.orderColumn ? [[Number(table.dataset.orderColumn), table.dataset.orderDirection || 'asc']] : [],
                autoWidth: false,
                responsive: false,
                language: {
                    search: '',
                    searchPlaceholder: 'Search...',
                    lengthMenu: 'Show _MENU_',
                    processing: 'Loading records...',
                    emptyTable: 'No records have been added yet.',
                    zeroRecords: 'No matching records found.'
                },
                drawCallback: function () { bindDeleteForms(); }
            });
        });
    }

    function initFilePond() {
        if (!window.FilePond) return;
        if (window.FilePondPluginImagePreview) FilePond.registerPlugin(FilePondPluginImagePreview);
        if (window.FilePondPluginFileValidateType) FilePond.registerPlugin(FilePondPluginFileValidateType);
        if (window.FilePondPluginFileValidateSize) FilePond.registerPlugin(FilePondPluginFileValidateSize);

        document.querySelectorAll('form input[type="file"]:not([data-filepond-disabled])').forEach(function (input) {
            if (input.dataset.pondReady === '1') return;
            input.dataset.pondReady = '1';

            const accept = input.getAttribute('accept') || '';
            const isVideo = accept.includes('video');
            const isAnimationHtml = input.dataset.fileKind === 'animation-html' || accept.includes('text/html') || accept.includes('.html');

            FilePond.create(input, {
                allowMultiple: false,
                storeAsFile: true,
                instantUpload: false,
                allowImagePreview: !isVideo && !isAnimationHtml,
                maxFileSize: isVideo ? '50MB' : '5MB',
                acceptedFileTypes: isVideo
                    ? ['video/mp4','video/webm']
                    : (isAnimationHtml ? ['text/html'] : ['image/jpeg','image/png','image/webp','image/avif']),
                labelIdle: isVideo
                    ? 'Drop video or <span class="filepond--label-action">browse</span>'
                    : (isAnimationHtml
                        ? 'Drop HTML animation or <span class="filepond--label-action">browse</span>'
                        : 'Drop image or <span class="filepond--label-action">browse</span>')
            });
        });
    }

    function initVisualMediaPickers() {
        document.querySelectorAll('[data-visual-media-picker]').forEach(function (picker) {
            if (picker.dataset.mediaReady === '1') return;
            picker.dataset.mediaReady = '1';

            const radios = picker.querySelectorAll('[data-media-type-radio]');
            const panels = picker.querySelectorAll('[data-media-panel]');
            const imageInput = picker.querySelector('[data-media-image-input]');
            const imageAlt = picker.querySelector('[data-media-image-alt]');
            const animationInput = picker.querySelector('[data-media-animation-input]');

            const refresh = function () {
                const checked = picker.querySelector('[data-media-type-radio]:checked');
                const type = checked ? checked.value : 'image';
                panels.forEach(function (panel) {
                    const active = panel.dataset.mediaPanel === type;
                    panel.classList.toggle('ring-1', active);
                    panel.classList.toggle('ring-neutron-300/30', active);
                    panel.classList.toggle('opacity-55', !active);
                });

                const hasCurrentImage = picker.dataset.hasCurrentImage === '1';
                const hasCurrentAnimation = picker.dataset.hasCurrentAnimation === '1';
                const hasNewImage = !!(imageInput && imageInput.files && imageInput.files.length);

                if (imageAlt) imageAlt.required = type === 'image' && (hasCurrentImage || hasNewImage);
                if (animationInput) animationInput.required = type === 'animation' && !hasCurrentAnimation;
            };

            radios.forEach(function (radio) { radio.addEventListener('change', refresh); });
            if (imageInput) imageInput.addEventListener('change', refresh);
            refresh();
        });
    }

    function initEditors() {
        if (!window.ClassicEditor) return;
        const selector = [
            'textarea[data-rich-editor]',
            'textarea[name="body"]',
            'textarea[name="description"]',
            'textarea[name="challenge"]',
            'textarea[name="solution"]',
            'textarea[name="outcome"]'
        ].join(',');

        document.querySelectorAll(selector).forEach(function (textarea) {
            if (textarea.dataset.editorReady === '1' || textarea.dataset.noRichEditor === '1') return;
            textarea.dataset.editorReady = '1';
            ClassicEditor.create(textarea, {
                toolbar: ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','insertTable','|','undo','redo']
            }).catch(function (error) { console.error('CKEditor initialization failed', error); });
        });
    }

    function ensureDeleteModal() {
        let modal = document.getElementById('a1-delete-modal');
        if (modal) return modal;
        modal = document.createElement('div');
        modal.id = 'a1-delete-modal';
        modal.className = 'fixed inset-0 z-[9999] hidden items-center justify-center bg-black/75 p-4 backdrop-blur-sm';
        modal.innerHTML = `
            <div class="w-full max-w-md rounded-2xl border border-white/10 bg-[#07111d] p-6 shadow-2xl">
                <p class="font-mono text-[10px] uppercase tracking-[.16em] text-red-200">Confirm deletion</p>
                <h2 class="mt-3 text-xl font-semibold text-white">Delete this item?</h2>
                <p id="a1-delete-copy" class="mt-3 text-sm leading-6 text-white/45">This action cannot be undone.</p>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" data-cancel class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/60">Cancel</button>
                    <button type="button" data-confirm class="rounded-lg bg-red-500 px-4 py-2.5 text-sm font-semibold text-white">Delete</button>
                </div>
            </div>`;
        document.body.appendChild(modal);
        return modal;
    }

    function bindDeleteForms() {
        document.querySelectorAll('form.js-delete-form:not([data-confirm-ready])').forEach(function (form) {
            form.dataset.confirmReady = '1';
            form.addEventListener('submit', function (event) {
                if (form.dataset.confirmed === '1') return;
                event.preventDefault();
                const modal = ensureDeleteModal();
                const label = form.dataset.deleteLabel || 'this record';
                modal.querySelector('#a1-delete-copy').textContent = 'Delete ' + label + '? This action cannot be undone.';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const close = function () { modal.classList.add('hidden'); modal.classList.remove('flex'); };
                modal.querySelector('[data-cancel]').onclick = close;
                modal.onclick = function (e) { if (e.target === modal) close(); };
                modal.querySelector('[data-confirm]').onclick = function () {
                    form.dataset.confirmed = '1';
                    close();
                    form.submit();
                };
            });
        });
    }

    function initUnsavedProtection() {
        document.querySelectorAll('form[data-unsaved-warning="true"], form[method="POST"]:not(.js-delete-form):not([data-no-unsaved-warning])').forEach(function (form) {
            let dirty = false;
            form.addEventListener('input', function () { dirty = true; });
            form.addEventListener('change', function () { dirty = true; });
            form.addEventListener('submit', function () { dirty = false; });
            window.addEventListener('beforeunload', function (event) {
                if (!dirty) return;
                event.preventDefault();
                event.returnValue = '';
            });
        });
    }


    function initAutoSlugs() {
        document.querySelectorAll('form').forEach(function (form) {
            const title = form.querySelector('input[name="title"], input[name="heading"]');
            const slug = form.querySelector('input[name="slug"], input[name="key"]');
            if (!title || !slug) return;
            let manuallyEdited = slug.value.trim() !== '';
            slug.addEventListener('input', function () { manuallyEdited = slug.value.trim() !== ''; });
            title.addEventListener('input', function () {
                if (manuallyEdited) return;
                slug.value = title.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            });
        });
    }

    function initSubmittingStates() {
        document.querySelectorAll('form:not(.js-delete-form)').forEach(function (form) {
            form.addEventListener('submit', function () {
                const button = form.querySelector('button[type="submit"], input[type="submit"]');
                if (!button || button.dataset.keepLabel === '1') return;
                if (button.tagName === 'BUTTON') {
                    button.dataset.originalText = button.textContent;
                    button.textContent = 'Saving...';
                }
                button.disabled = true;
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initTables();
        initVisualMediaPickers();
        initFilePond();
        initEditors();
        bindDeleteForms();
        initUnsavedProtection();
        initAutoSlugs();
        initSubmittingStates();
    });
})();
</script>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\layouts\admin-enhancements.blade.php ENDPATH**/ ?>