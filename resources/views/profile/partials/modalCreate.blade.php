<style>
    /* Небольшие донастройки для кастомной цветовой гаммы, без style нельзя обойтись для совместимости с вашими переменными, но они минимальны */
    :root {
        --color-primary: #4976F0;
        --color-primary-content: #e3cee4;
        --color-secondary: oklch(39.9% 0.214 241.360);
        --color-accent: #4E8EA2;
        --color-success: #10B981;
        --color-warning: #F59E0B;
        --color-error: #EF4444;
    }
    .btn-primary-custom {
        background-color: #4976F0;
        color: white;
    }
    .btn-primary-custom:hover {
        background-color: #3a5fcc;
    }
</style>
<body class="bg-base-200 min-h-screen flex items-center justify-center p-4" style="background: oklch(96% 0.003 264.542);">

<!-- Демо-кнопка для открытия модального окна (для теста, вы её замените на свою) -->

<!-- Модальное окно (диалог) -->
<dialog id="profileModal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box rounded-2xl max-w-2xl p-0 overflow-hidden" style="background: white; max-height: 85vh; display: flex; flex-direction: column;">
        <!-- Заголовок с градиентом -->
        <div class="bg-gradient-to-r from-[#4976F0] to-[#4E8EA2] px-6 py-4">
            <h3 class="text-xl font-bold text-white">📝 Заполнение профиля</h3>
            <p class="text-white/80 text-sm">Расскажите о себе, чтобы другие могли узнать вас лучше</p>
        </div>

        <!-- Форма с прокруткой -->
        <div class="p-6 overflow-y-auto flex-1">
            <form id="profileForm" class="space-y-5" action="{{ route('profile.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
{{--                @foreach(\App\Models\Animal::all() as $s)--}}
{{--                <input type="hidden" name="animal_id" value="{{ $s->id }}">--}}
{{--                @endforeach--}}
                <!-- Два поля в ряд: name + surname -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Имя <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Например: Александр" class="input input-bordered w-full" style="border-radius: 0.75rem;" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Фамилия <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="surname" name="surname" placeholder="Например: Тихонов" class="input input-bordered w-full" style="border-radius: 0.75rem;" />
                    </div>
                </div>

                <!-- Контакт (email или телефон) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Контакт (email / телефон) <span class="text-error">*</span></span>
                    </label>
                    <input type="text" id="contact" name="contact" placeholder="example@mail.com  или +7 123 456-78-90" class="input input-bordered w-full" style="border-radius: 0.75rem;" required />
                </div>

                <!-- Два селекта: gender и status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Пол</span>
                        </label>
                        <select id="gender_id" name="gender_id" class="select select-bordered w-full" style="border-radius: 0.75rem;">
                            <option disabled selected>Выберите пол</option>
                        @forelse(\App\Models\Gender::all() as $g)
                            <option value="{{ $g->id }}">{{ $g->gender }}</option>
                        @empty
                            <option disabled class="bold">Технические проблемы</option>
                        @endforelse
                        </select>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Статус</span>
                        </label>
                        <select id="status" name="status_id" class="select select-bordered w-full" style="border-radius: 0.75rem;">
                                <option value="" disabled selected>Выберите статус</option>
                            @forelse(\App\Models\Status::all() as $s)
                                <option value="{{ $s->id }}">{{ $s->status }}</option>
                            @empty
                                <option disabled class="bold">Технические проблемы</option>
                            @endforelse

                        </select>
                    </div>
                </div>
                <!-- Интересы (текстовое поле с подсказкой) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Интересы</span>
                    </label>
                    <input type="text" id="interests" name="interests" placeholder="Например: фотография, путешествия, IT, спорт" class="input input-bordered w-full" style="border-radius: 0.75rem;" />
                    <label class="label">
                        <span class="label-text-alt text-gray-500">Перечислите через запятую</span>
                    </label>
                </div>

                <!-- Город -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Город</span>
                    </label>
                    <input type="text" id="city" name="city" placeholder="Санкт-Петербург, Москва, Казань..." class="input input-bordered w-full" style="border-radius: 0.75rem;" />
                </div>

                <!-- Аватар (ссылка на изображение) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Аватар (фото)</span>
                    </label>
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp,image/gif" class="file-input file-input-bordered w-full" style="border-radius: 0.75rem;" />
                    <label class="label">
                        <span class="label-text-alt">Поддерживаются JPG, PNG, Максимум 5 МБ</span>
                    </label>
                </div>

                <!-- Описание (textarea) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Описание / О себе</span>
                    </label>
                    <textarea id="description" name="description" rows="3" class="textarea textarea-bordered w-full" placeholder="Расскажите о своих увлечениях, достижениях или любимых цитатах..." style="border-radius: 0.75rem;"></textarea>
                </div>

                <div class="text-xs text-gray-400 mt-1">* — обязательные поля</div>
                <div class="modal-action p-6 pt-0 border-t border-gray-100 flex justify-end gap-3">
                    <button id="closeModalBtn" class="btn btn-ghost px-6" style="border-radius: 2rem;">Отмена</button>
                    <button type="submit" class="btn text-white px-8" style="background: #10B981; border: none; border-radius: 2rem;">💾 Сохранить</button>
                </div>

            </form>
        </div>
    </div>
    <!-- Клик по фону закрывает окно (форма затемнения) -->
    <form method="dialog" class="modal-backdrop">
        <button>закрыть</button>
    </form>
</dialog>

<!-- Минимальный скрипт для управления модалкой и сбора данных (без лишних библиотек) -->
<script>
    (function() {
        const modal = document.getElementById('profileModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const form = document.getElementById('profileForm');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                modal.showModal();
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.close();
            });
        }
    })();
</script>
