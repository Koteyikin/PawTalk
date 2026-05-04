<dialog id="article_modal" class="modal modal-bottom sm:modal-middle">

    {{-- Backdrop --}}
    <div class="modal-backdrop bg-neutral/40 backdrop-blur-sm" onclick="article_modal.close()"></div>

    <div class="modal-box bg-base-200 border border-base-300 rounded-3xl shadow-2xl p-0 w-full max-w-2xl overflow-hidden">

        {{-- ── HEADER ── --}}
        <div class="relative px-8 pt-8 pb-6 border-b border-base-300"
             style="background: linear-gradient(135deg, var(--custom, #545871) 0%, #3a3d52 100%);">

            {{-- Декоративные лапки --}}
            <span class="absolute right-8 top-3 text-5xl opacity-[0.07] select-none pointer-events-none">🐾</span>
            <span class="absolute right-20 bottom-2 text-3xl opacity-[0.05] select-none pointer-events-none">🐾</span>

            {{-- Закрыть --}}
            <button onclick="article_modal.close()"
                    class="absolute top-4 right-4 btn btn-sm btn-ghost text-white/50 hover:text-white hover:bg-white/10 rounded-full w-9 h-9 p-0 min-h-0">
                ✕
            </button>

            <div class="relative z-10">
                <div class="badge bg-primary/30 text-blue-200 border-primary/40 text-xs font-bold uppercase tracking-widest mb-3">
                    Новая статья
                </div>
                <h2 class="font-display text-2xl font-bold text-white leading-tight">
                    Поделитесь своим опытом
                </h2>
                <p class="text-white/50 text-sm mt-1">
                    Статья будет отправлена на проверку модератору
                </p>
            </div>
        </div>

        {{-- ── ФОРМА ── --}}
         <form id="article-form" method="POST" action="{{ route('articles.store') }}"
              enctype="multipart/form-data"
              class="px-8 py-6 flex flex-col gap-5 max-h-[70vh] overflow-y-auto">
            @csrf
             <input type="hidden" value="false" name="is_featured"/>
             <input type="hidden" value="pending" name="status">
             <input type="hidden" value="{{ auth()->id()}}" name="user_id">
            {{-- Заголовок --}}
            <div class="form-control gap-1.5">
                <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                    Заголовок <span class="text-error">*</span>
                </label>
                <input type="text"
                       name="title"
                       placeholder="Например: Как приучить кошку к переноске"
                       class="input bg-base-100 border border-base-300 rounded-2xl px-4 py-3 text-sm
                              focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/15
                              placeholder:text-base-content/30 transition-all w-full"
                       required />
                @error('title')
                <span class="text-error text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Категория + Теги в строку --}}
            <div class="grid grid-cols-2 gap-4">

                {{-- Категория --}}
                <div class="form-control gap-1.5">
                    <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                        Категория <span class="text-error">*</span>
                    </label>
                    <select name="category_id"
                            class="select bg-base-100 border border-base-300 rounded-2xl px-4 text-sm
                                   focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/15
                                   transition-all w-full"
                            required>
                        {{-- В реальном проекте: @foreach($categories as $cat) --}}
                        <option value="" disabled selected>Выберите...</option>
                        @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>

                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-error text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Время чтения --}}
                <div class="form-control gap-1.5">
                    <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                        Время чтения (мин)
                    </label>
                    <input type="number"
                           name="reading_time"
                           min="1" max="60"
                           placeholder="5"
                           class="input bg-base-100 border border-base-300 rounded-2xl px-4 py-3 text-sm
                                  focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/15
                                  placeholder:text-base-content/30 transition-all w-full" />
                </div>
            </div>

            {{-- Краткое описание --}}
            <div class="form-control gap-1.5">
                <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                    Краткое описание
                    <span class="text-base-content/30 font-normal normal-case tracking-normal ml-1">(отображается в карточке)</span>
                </label>
                <textarea name="excerpt"
                          rows="2"
                          placeholder="Пара предложений о чём эта статья..."
                          class="textarea bg-base-100 border border-base-300 rounded-2xl px-4 py-3 text-sm resize-none
                                 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/15
                                 placeholder:text-base-content/30 transition-all w-full"></textarea>
            </div>

            {{-- Текст статьи --}}
            <div class="form-control gap-1.5">
                <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                    Текст статьи <span class="text-error">*</span>
                </label>

                @include('components.rich-editor')
                @error('body')
                <span class="text-error text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Теги --}}
            <div class="form-control gap-2">
                <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                    Теги
                    <span class="text-base-content/30 font-normal normal-case tracking-normal ml-1">(можно выбрать несколько)</span>
                </label>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Models\Tag::all() as $tag)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                            <span class="badge badge-ghost peer-checked:bg-primary peer-checked:text-white
                                         peer-checked:border-primary px-3 py-2.5 text-xs font-semibold
                                         transition-all hover:border-primary/50 cursor-pointer select-none">
                                {{ $tag->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Обложка --}}
            <div class="form-control gap-1.5">
                <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                    Обложка статьи
                </label>
                <label class="flex flex-col items-center justify-center gap-2 cursor-pointer
                               border-2 border-dashed border-base-300 rounded-2xl p-6
                               hover:border-primary/50 hover:bg-primary/5 transition-all group"
                       id="cover-label">
                    <span class="text-3xl group-hover:scale-110 transition-transform" id="cover-icon">🖼️</span>
                    <span class="text-sm text-base-content/50 group-hover:text-primary transition-colors" id="cover-text">
                        Нажмите для загрузки обложки
                    </span>
                    <span class="text-xs text-base-content/30">PNG, JPG до 2MB</span>
                    <input type="file" name="image" accept="image/*" class="hidden"/>
                </label>
            </div>

            {{-- Инфо о модерации --}}
            <div class="flex items-start gap-3 p-4 bg-info/10 border border-info/20 rounded-2xl">
                <span class="text-lg mt-0.5 flex-shrink-0">ℹ️</span>
                <div>
                    <div class="text-sm font-semibold text-base-content/70">Проверка модератором</div>
                    <div class="text-xs text-base-content/45 leading-relaxed mt-0.5">
                        После отправки статья получит статус «На проверке». Вы получите уведомление,
                        когда модератор одобрит или отклонит её.
                    </div>
                </div>
            </div>
             @if ($errors->any())
                 <div style="color:red;">
                     @foreach ($errors->all() as $error)
                         <div>{{ $error }}</div>
                     @endforeach
                 </div>
             @endif
        </form>

        {{-- ── FOOTER ── --}}
        <div class="px-8 py-5 border-t border-base-300 bg-base-100 flex items-center justify-between gap-3">
            <button onclick="article_modal.close()"
                    class="btn btn-ghost btn-sm rounded-full px-6 text-base-content/50 hover:text-base-content">
                Отмена
            </button>

            <div class="flex items-center gap-3">
                {{-- Сохранить черновик --}}
                <button type="button"
                        onclick="submitDraft()"
                        class="btn btn-sm btn-outline rounded-full px-6 border-base-300
                               text-base-content/60 hover:border-primary hover:text-primary transition-all">
                    📝 Черновик
                </button>

                {{-- Отправить на модерацию --}}
                <button type="submit"
                        form="article-form"
                        class="btn btn-primary btn-sm rounded-full px-7 text-white border-none
                               shadow-lg hover:shadow-primary/30 hover:-translate-y-0.5 transition-all">
                    Отправить на проверку →
                </button>
            </div>
        </div>
    </div>
</dialog>
