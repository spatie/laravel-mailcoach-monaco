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
                    theme: '{!! config('mailcoach.monaco.theme', 'vs-light') !!}',
                    fontFamily: '{!! config('mailcoach.monaco.fontFamily', 'Menlo, Monaco, "Courier New", monospace') !!}',
                    fontSize: '{!! config('mailcoach.monaco.fontSize', '12') !!}',
                    fontWeight: '{!! config('mailcoach.monaco.fontWeight', '400') !!}',
                    fontLigatures: {!! config('mailcoach.monaco.fontLigatures', false) ? 'true' : 'false' !!},
                    lineHeight: '{!! config('mailcoach.monaco.lineHeight', '18') !!}',
                });

                document.getElementById('save').addEventListener('click', event => {
                    event.preventDefault();
                    document.getElementById('html').value = window.editor.getValue();
                    document.querySelector('.layout-main form').submit();
                });

                document.getElementById('preview').addEventListener('click', event => {
                    event.preventDefault();
                    document.getElementById('html').value = window.editor.getValue();
                    const input = document.createEvent('Event');
                    input.initEvent('input', true, true);
                    document.getElementById('html').dispatchEvent(input);
                    showModal('preview');
                });
            });
        });
    </script>
@endpush
<div>
    @error('html')
        <p class="form-error mb-2" role="alert">{{ $message }}</p>
    @enderror
    <div id="monaco-container" style="position: relative;width:100%;height:700px;border:1px solid #ebf1f7"></div>
    <input type="hidden" id="html" name="html" value="{{ old('html', $html) }}" data-html-preview-source>
</div>

<div class="form-buttons">
    <button id="save" type="submit" class="button">
        <x-mailcoach::icon-label icon="fa-code" :text="__('Save content')"/>
    </button>

    <button id="preview" type="button" class="link-icon" data-modal-trigger="preview">
        <x-mailcoach::icon-label icon="fa-eye" :text="__('Preview')"/>
    </button>
    <x-mailcoach::modal title="Preview" name="preview" large>
        <iframe class="absolute" width="100%" height="100%" data-html-preview-target></iframe>
    </x-mailcoach::modal>
</div>

