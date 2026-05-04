@props(['name' => 'body', 'value' => ''])

<div>
    {{-- Скрытый input для формы --}}
    <input type="hidden" name="{{ $name }}" id="input-{{ $name }}" value="{{ $value }}">

    {{-- Тулбар --}}
    <div id="toolbar-{{ $name }}"
         class="flex flex-wrap items-center gap-0.5 px-3 py-2
                bg-base-100 border border-base-300 rounded-t-2xl">

        <button type="button" data-cmd="bold"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 font-bold text-sm"
                title="Жирный">B</button>

        <button type="button" data-cmd="italic"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 italic text-sm"
                title="Курсив">I</button>

        <button type="button" data-cmd="underline"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 underline text-sm"
                title="Подчёркивание">U</button>

        <button type="button" data-cmd="strikeThrough"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 line-through text-sm"
                title="Зачёркивание">S</button>

        <div class="w-px h-5 bg-base-300 mx-1"></div>

        <button type="button" data-cmd="h2"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg px-2 h-8 min-h-0 text-xs font-bold"
                title="Заголовок 2">H2</button>

        <button type="button" data-cmd="h3"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg px-2 h-8 min-h-0 text-xs font-bold"
                title="Заголовок 3">H3</button>

        <div class="w-px h-5 bg-base-300 mx-1"></div>

        <button type="button" data-cmd="insertUnorderedList"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Маркированный список">•≡</button>

        <button type="button" data-cmd="insertOrderedList"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Нумерованный список">1≡</button>

        <button type="button" data-cmd="blockquote"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Цитата">❝</button>

        <div class="w-px h-5 bg-base-300 mx-1"></div>

        <button type="button" data-cmd="justifyLeft"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="По левому краю">⬅</button>

        <button type="button" data-cmd="justifyCenter"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="По центру">≡</button>

        <button type="button" data-cmd="justifyRight"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="По правому краю">➡</button>

        <div class="w-px h-5 bg-base-300 mx-1"></div>

        <button type="button" data-cmd="link"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Ссылка">🔗</button>

        <button type="button" data-cmd="table"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Таблица">⊞</button>

        <div class="w-px h-5 bg-base-300 mx-1"></div>

        <button type="button" data-cmd="undo"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Отменить">↩</button>

        <button type="button" data-cmd="redo"
                class="toolbar-btn btn btn-xs btn-ghost rounded-lg w-8 h-8 p-0 min-h-0 text-sm"
                title="Повторить">↪</button>

        <div class="ml-auto text-xs text-base-content/30 pr-1">
            <span id="wc-{{ $name }}">0</span> сл.
        </div>
    </div>

    {{-- Область редактирования --}}
    <div id="editor-{{ $name }}"
         contenteditable="true"
         class="min-h-48 bg-base-100 border border-base-300 border-t-0 rounded-b-2xl
                px-5 py-4 text-sm text-base-content outline-none
                focus:border-primary focus:ring-2 focus:ring-primary/15
                [&_blockquote]:border-l-4 [&_blockquote]:border-primary/40
                [&_blockquote]:bg-primary/5 [&_blockquote]:px-4 [&_blockquote]:py-2
                [&_blockquote]:rounded-r-xl [&_blockquote]:my-2
                [&_div.table-wrapper]:overflow-x-auto [&_div.table-wrapper]:my-2
                [&_table]:border-collapse [&_table]:min-w-full
                [&_td]:border [&_td]:border-base-300 [&_td]:p-2
                [&_th]:border [&_th]:border-base-300 [&_th]:p-2 [&_th]:bg-base-200
                [&_h2]:text-xl [&_h2]:font-bold [&_h2]:my-2
                [&_h3]:text-lg [&_h3]:font-bold [&_h3]:my-2
                [&_a]:text-primary [&_a]:underline
                [&_ul]:list-disc [&_ul]:pl-5
                [&_ol]:list-decimal [&_ol]:pl-5"
         data-placeholder="Начните писать вашу статью...">
        {!! $value !!}
    </div>
</div>

@push('scripts')
    <script>
        (function() {
            function initEditor(name) {
                const toolbar  = document.getElementById('toolbar-' + name)
                const editor   = document.getElementById('editor-' + name)
                const input    = document.getElementById('input-' + name)
                const wcEl     = document.getElementById('wc-' + name)

                if (!toolbar || !editor || !input) return

                // Placeholder
                editor.addEventListener('focus', () => {
                    if (editor.textContent.trim() === '') {
                        editor.innerHTML = ''
                    }
                })

                // Синхронизация с input
                editor.addEventListener('input', () => {
                    input.value = editor.innerHTML
                    const text = editor.innerText.trim()
                    wcEl.textContent = text ? text.split(/\s+/).length : 0
                })

                // Обработка кнопок тулбара
                toolbar.querySelectorAll('.toolbar-btn').forEach(btn => {
                    btn.addEventListener('mousedown', (e) => {
                        e.preventDefault() // не теряем фокус с редактора
                        editor.focus()

                        const cmd = btn.dataset.cmd

                        if (cmd === 'h2' || cmd === 'h3') {
                            document.execCommand('formatBlock', false, cmd)

                        } else if (cmd === 'blockquote') {
                            document.execCommand('formatBlock', false, 'blockquote')

                        } else if (cmd === 'link') {
                            const url = window.prompt('Введите URL:')
                            if (url) document.execCommand('createLink', false, url)

                        } else if (cmd === 'table') {
                            const rows = parseInt(window.prompt('Количество строк:', '3')) || 3
                            const cols = parseInt(window.prompt('Количество столбцов:', '3')) || 3

                            let html = '<div class="table-wrapper"><table><thead><tr>'
                            for (let c = 0; c < cols; c++) {
                                html += '<th>Заголовок ' + (c + 1) + '</th>'
                            }
                            html += '</tr></thead><tbody>'
                            for (let r = 0; r < rows - 1; r++) {
                                html += '<tr>'
                                for (let c = 0; c < cols; c++) {
                                    html += '<td>&nbsp;</td>'
                                }
                                html += '</tr>'
                            }
                            html += '</tbody></table></div><p><br></p>'
                            document.execCommand('insertHTML', false, html)

                        } else {
                            document.execCommand(cmd, false, null)
                        }

                        // Синхронизируем после команды
                        input.value = editor.innerHTML

                        // Подсвечиваем активные кнопки
                        updateActiveButtons()
                    })
                })

                // Подсветка активных кнопок при смене позиции курсора
                editor.addEventListener('keyup', updateActiveButtons)
                editor.addEventListener('mouseup', updateActiveButtons)

                function updateActiveButtons() {
                    toolbar.querySelectorAll('.toolbar-btn').forEach(btn => {
                        const cmd = btn.dataset.cmd
                        let active = false
                        try {
                            if (['bold','italic','underline','strikeThrough',
                                'insertUnorderedList','insertOrderedList',
                                'justifyLeft','justifyCenter','justifyRight'].includes(cmd)) {
                                active = document.queryCommandState(cmd)
                            }
                        } catch(e) {}
                        btn.classList.toggle('bg-primary/15', active)
                        btn.classList.toggle('text-primary', active)
                    })
                }
            }

            // Если редактор вне модалки — инициализируем сразу
            document.addEventListener('DOMContentLoaded', () => {
                const name = '{{ $name }}'
                const editor = document.getElementById('editor-' + name)
                if (!editor) return

                const modal = editor.closest('dialog')
                if (modal) {
                    // Ждём открытия модалки
                    const observer = new MutationObserver(() => {
                        if (modal.open) {
                            initEditor(name)
                            observer.disconnect()
                        }
                    })
                    observer.observe(modal, { attributes: true, attributeFilter: ['open'] })
                } else {
                    initEditor(name)
                }
            })
        })()
    </script>
@endpush
