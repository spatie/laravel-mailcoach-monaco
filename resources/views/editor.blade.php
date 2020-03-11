@push('endHead')
    <script src="{{ asset('vendor/mailcoach/monaco/vs/loader.js') }}"></script>
    <script>
        document.addEventListener('turbolinks:load', function() {
            const container = document.getElementById('monaco-container');

            if (! container) {
                return;
            }

            if (window.require === undefined || window.editor) {
                location.reload();
                return;
            }

            require.config({ paths: { 'vs': '{{ asset('vendor/mailcoach/monaco/vs') }}' }});

            require(['vs/editor/editor.main'], function() {
                window.editor = monaco.editor.create(container, {
                    value: JSON.parse('{!! addslashes(json_encode(explode("\n", old('html', $html)))) !!}').join('\n'),
                    language: 'html',
                    minimap: {
                        enabled: false
                    },
                    fixedOverflowWidgets: {},
                    theme: '{{ config('mailcoach.monaco.theme', 'vs-light') }}'
                });

                document.getElementById('save').addEventListener('click', event => {
                    event.preventDefault();
                    document.getElementById('html').value = window.editor.getValue();
                    document.querySelector('.layout-main form').submit();
                });
            });
        });
    </script>
@endpush
<div>
    <div id="monaco-container" style="position: relative;width:100%;height:700px;border:1px solid #ebf1f7"></div>
    <input type="hidden" id="html" name="html" value="{{ old('html', $html) }}" data-html-preview-source>
</div>

<div class="form-buttons">
    <button id="save" type="submit" class="button">
        <x-icon-label icon="fa-code" text="Save content"/>
    </button>

    <button type="button" class="link-icon" data-modal-trigger="preview">
        <x-icon-label icon="fa-eye" text="Preview"/>
    </button>
    <x-modal title="Preview" name="preview" large>
        <iframe class="absolute" width="100%" height="100%" data-html-preview-target></iframe>
    </x-modal>
</div>
