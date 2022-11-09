<div class="form-grid">
    <script>
        function debounce(func, timeout = 300){
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
            };
        }

        window.init = function () {
            require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/vs' }});

            window.MonacoEnvironment = {
                getWorkerUrl: function (workerId, label) {
                    return `data:text/javascript;charset=utf-8,${encodeURIComponent(`
                          self.MonacoEnvironment = {
                            baseUrl: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/'
                          };
                          importScripts('https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/vs/base/worker/workerMain.js');`
                    )}`
                }
            }

            const component = this;

            require(['vs/editor/editor.main'], () => initializeMonaco());

            function initializeMonaco() {
                monaco.editor.getModels().forEach(model => model.dispose());

                component.$nextTick(() => {
                    let editor = monaco.editor.create(component.$refs.editor, {
                        value: component.value.html || component.value,
                        language: 'html',
                        minimap: {
                            enabled: false
                        },
                        fixedOverflowWidgets: {},
                        theme: '{!! config('mailcoach-monaco.theme', 'vs-light') !!}',
                        fontSize: '{!! config('mailcoach-monaco.fontSize', '12') !!}',
                        fontWeight: '{!! config('mailcoach-monaco.fontWeight', '400') !!}',
                        fontLigatures: {!! config('mailcoach-monaco.fontLigatures', false) ? 'true' : 'false' !!},
                        lineHeight: '{!! config('mailcoach-monaco.lineHeight', '18') !!}',
                        scrollbar: {
                            alwaysConsumeMouseWheel: false,
                        }
                    });

                    editor.getModel().onDidChangeContent(debounce(() => {
                        component.$refs.editor.dirty = true;
                        component.value = editor.getValue();
                    }));
                });

            }
        }
    </script>

    @if ($model->hasTemplates())
        <x-mailcoach::template-chooser />
    @endif

    @foreach($template?->fields() ?? [['name' => 'html', 'type' => 'editor']] as $field)
        <x-mailcoach::editor-fields :name="$field['name']" :type="$field['type']">
            <x-slot name="editor">
                <div wire:ignore x-data="{
                    name: '{{ $field['name'] }}',
                    value: @entangle('templateFieldValues.' . $field['name']),
                    init: init,
                }">
                    <div x-ref="editor" class="input px-0 h-[700px]" data-dirty-check></div>
                </div>
            </x-slot>
        </x-mailcoach::editor-fields>
    @endforeach

    <x-mailcoach::replacer-help-texts :model="$model" />
    <x-mailcoach::editor-buttons :preview-html="$fullHtml" :model="$model" />
</div>

