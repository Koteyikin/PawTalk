@extends('layouts.main')
@section('title', 'Профиль')
@section('body')
    <div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
        <!-- Карточка профиля с аватаркой и обложкой в стиле daisyUI -->
        <div class="rounded-box bg-base-100 shadow-xl overflow-hidden" style="background-color: var(--color-base-100, oklch(100% 0 0)); --color-base-100: oklch(100% 0 0);">
            <!-- Шапка профиля с обложкой -->
            <div class="relative h-36 md:h-48 bg-gradient-to-r from-[#4976F0] to-[#4E8EA2]"></div>
            <div class="relative px-6 pb-6">
                <!-- Аватар -->
                    <div class="absolute -top-12 left-6">
                        <div class="avatar">
                            <div class="w-24 rounded-full ring-4 ring-base-100" style="background: #e3cee4;">
                                <img src="{{ $about?->avatar ? asset('storage/' . $about->avatar) : 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . auth()->user()->nickname }}" alt="avatar" class="rounded-full">
                            </div>
                        </div>
                    </div>
                <div class="pt-14 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold" style="color: oklch(27.807% 0.029 256.847);"></h1>
                        <div class="flex flex-wrap gap-2 mt-1 items-center">
                            <span class="badge badge-primary gap-1 text-xs" style="background: #4976F0; border: none; color: white;">{{ $about?->status->name ?? 'Статус не выбран' }}</span>
                            <span class="text-xs opacity-70">Присоединился:{{ auth()->user()?->created_at ?? 'Пока еще не известно'}}</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="btn btn-sm gap-1" style="background: #F59E0B; border: none; color: #1f2937;">✉ Создать статью</button>
                    </div>
                </div>
            </div>

            <!-- Вкладки (Tabs) с использованием daisyUI + интерактив -->
{{--            <div class="px-6 border-b" style="border-color: oklch(86% 0.022 252.894 / 0.3);">--}}
{{--                <div class="flex flex-wrap gap-1 -mb-px" id="tabHeaders">--}}
{{--                    <button data-tab="profile" class="tab-btn text-base font-medium px-4 py-2 rounded-t-lg transition-all border-b-2 border-transparent hover:bg-base-200" style="color: oklch(27.807% 0.029 256.847);">👤 Просмотр профиля</button>--}}
{{--                    <button data-tab="animal" class="tab-btn text-base font-medium px-4 py-2 rounded-t-lg transition-all border-b-2 border-transparent hover:bg-base-200" style="color: oklch(27.807% 0.029 256.847);">🐾 Любимое животное</button>--}}
{{--                    <button data-tab="articles" class="tab-btn text-base font-medium px-4 py-2 rounded-t-lg transition-all border-b-2 border-transparent hover:bg-base-200" style="color: oklch(27.807% 0.029 256.847);">📄 Мои статьи</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Контент вкладок -->--}}
{{--            <div class="p-6">--}}
{{--                <!-- Вкладка: Просмотр профиля -->--}}
{{--

{{--                <!-- Вкладка: Любимое животное -->--}}
{{--                <div id="animalTab" class="tab-content hidden transition-all duration-200">--}}
{{--                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                        <div class="card bg-base-200 shadow-md rounded-box overflow-hidden" style="background: white;">--}}
{{--                            <figure class="px-6 pt-6">--}}
{{--                                <img src="https://images.unsplash.com/photo-1535268647677-300dbf3d6d1b?w=400&h=300&fit=crop" alt="Рысь" class="rounded-xl w-full h-48 object-cover shadow-sm">--}}
{{--                            </figure>--}}
{{--                            <div class="card-body">--}}
{{--                                <h2 class="card-title" style="color: #4976F0;">🐆 Рысь</h2>--}}
{{--                                <p>Грациозный и скрытный хищник, символ дикой тайги. Обожаю этих кошек за уши-кисточки и независимый характер.</p>--}}
{{--                                <div class="badge badge-secondary mt-2" style="background: #4E8EA2; border: none;">Лесной страж</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card bg-base-200 shadow-md rounded-box p-5" style="background: white;">--}}
{{--                            <h3 class="text-2xl font-bold flex items-center gap-2"><span>🦊</span> Почему рысь?</h3>--}}
{{--                            <div class="mt-3 space-y-3 text-base-content/80">--}}
{{--                                <p>✅ Отличный слух и зрение — как у настоящего рассказчика деталей.</p>--}}
{{--                                <p>✅ Символ загадочности и свободы.</p>--}}
{{--                                <p>✅ Встретил однажды в Карелии — впечатлило на всю жизнь.</p>--}}
{{--                                <p>✅ Также уважаю красных волков и белых медведей.</p>--}}
{{--                            </div>--}}
{{--                            <div class="mt-4 flex flex-wrap gap-2">--}}
{{--                                <div class="rating rating-sm">--}}
{{--                                    <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked disabled/>--}}
{{--                                    <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked disabled/>--}}
{{--                                    <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked disabled/>--}}
{{--                                    <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked disabled/>--}}
{{--                                </div>--}}
{{--                                <span class="text-xs">Любовь безгранична</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="md:col-span-2 bg-base-100 rounded-box p-4 text-sm" style="background: oklch(96% 0.003 264.542);">--}}
{{--                            <span class="font-semibold">📸 Любимые фото:</span> Архив наблюдений за животными пополняется каждый месяц.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Вкладка: Редактирование профиля (форма) -->--}}
{{--                <div id="editTab" class="tab-content hidden transition-all duration-200">--}}
{{--                    <div class="card max-w-2xl mx-auto bg-base-200 rounded-box p-6" style="background: white;">--}}
{{--                        <h2 class="text-2xl font-bold mb-4" style="color: #4976F0;">Редактировать профиль</h2>--}}
{{--                        <form class="space-y-4" onsubmit="alert('Данные сохранены (демо)'); return false;">--}}
{{--                            <div class="form-control w-full">--}}
{{--                                <label class="label"><span class="label-text font-medium">Имя пользователя</span></label>--}}
{{--                                <input type="text" placeholder="Александр Т." class="input input-bordered w-full" style="border-radius: var(--radius-field, 1rem);" value="Александр Т." />--}}
{{--                            </div>--}}
{{--                            <div class="form-control w-full">--}}
{{--                                <label class="label"><span class="label-text">Email</span></label>--}}
{{--                                <input type="email" placeholder="email@example.com" class="input input-bordered w-full" value="alex@example.com" />--}}
{{--                            </div>--}}
{{--                            <div class="form-control w-full">--}}
{{--                                <label class="label"><span class="label-text">О себе</span></label>--}}
{{--                                <textarea class="textarea textarea-bordered h-24" placeholder="Расскажите о себе">Путешественник, фотограф и автор статей о природе. Исследую дикие уголки планеты и делюсь историями.</textarea>--}}
{{--                            </div>--}}
{{--                            <div class="form-control w-full">--}}
{{--                                <label class="label"><span class="label-text">Любимое животное</span></label>--}}
{{--                                <select class="select select-bordered">--}}
{{--                                    <option>Рысь</option>--}}
{{--                                    <option>Волк</option>--}}
{{--                                    <option>Дельфин</option>--}}
{{--                                    <option>Орёл</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="flex gap-3 pt-2">--}}
{{--                                <button type="submit" class="btn text-white" style="background: #10B981; border: none;">Сохранить изменения</button>--}}
{{--                                <button type="reset" class="btn btn-ghost">Отмена</button>--}}
{{--                            </div>--}}
{{--                            <div class="alert alert-warning mt-3 text-sm" style="background: #FEF3C7; color: #92400E;">--}}
{{--                                <span>⚠️ В демо-режиме данные не отправляются на сервер.</span>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Вкладка: Мои статьи -->--}}
{{--                <div id="articlesTab" class="tab-content hidden transition-all duration-200">--}}
{{--                    <div class="flex flex-col gap-5">--}}
{{--                        <div class="flex justify-between items-center flex-wrap">--}}
{{--                            <h3 class="text-2xl font-bold" style="color: #4976F0;">📚 Публикации</h3>--}}
{{--                            <button class="btn btn-sm btn-outline" style="border-color: #4976F0; color: #4976F0;">+ Новая статья</button>--}}
{{--                        </div>--}}
{{--                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">--}}
{{--                            <!-- Карточка статьи 1 -->--}}
{{--                            <div class="card card-side bg-base-100 shadow-md rounded-box overflow-hidden" style="background: white;">--}}
{{--                                <figure class="w-2/5 bg-[#e3cee4] flex items-center justify-center text-4xl">🏔️</figure>--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <h4 class="card-title text-lg">10 лучших троп Кавказа</h4>--}}
{{--                                    <p class="text-sm opacity-80">Опубликовано 12 мая 2025 · 4 мин чтения</p>--}}
{{--                                    <div class="card-actions justify-end mt-2">--}}
{{--                                        <span class="badge badge-primary" style="background: #4976F0;">Путешествия</span>--}}
{{--                                        <span class="badge badge-ghost">❤️ 128</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card card-side bg-base-100 shadow-md rounded-box overflow-hidden" style="background: white;">--}}
{{--                                <figure class="w-2/5 bg-[#7BBDE8] flex items-center justify-center text-4xl">🦉</figure>--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <h4 class="card-title text-lg">Как наблюдать за совами</h4>--}}
{{--                                    <p class="text-sm opacity-80">Опубликовано 3 апреля 2025 · 6 мин чтения</p>--}}
{{--                                    <div class="card-actions justify-end mt-2">--}}
{{--                                        <span class="badge badge-primary" style="background: #4E8EA2;">Дикая природа</span>--}}
{{--                                        <span class="badge badge-ghost">❤️ 342</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card card-side bg-base-100 shadow-md rounded-box overflow-hidden" style="background: white;">--}}
{{--                                <figure class="w-2/5 bg-[#F59E0B]/20 flex items-center justify-center text-4xl">🏕️</figure>--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <h4 class="card-title text-lg">Эко-лагерь на Байкале</h4>--}}
{{--                                    <p class="text-sm opacity-80">Опубликовано 21 февраля 2025 · 8 мин чтения</p>--}}
{{--                                    <div class="card-actions justify-end mt-2">--}}
{{--                                        <span class="badge badge-primary" style="background: #10B981;">Экология</span>--}}
{{--                                        <span class="badge badge-ghost">❤️ 97</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card card-side bg-base-100 shadow-md rounded-box overflow-hidden" style="background: white;">--}}
{{--                                <figure class="w-2/5 bg-[#545871]/20 flex items-center justify-center text-4xl">📷</figure>--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <h4 class="card-title text-lg">Фотоловушки: секреты</h4>--}}
{{--                                    <p class="text-sm opacity-80">Опубликовано 10 января 2025 · 5 мин чтения</p>--}}
{{--                                    <div class="card-actions justify-end mt-2">--}}
{{--                                        <span class="badge" style="background: #545871; color: white;">Советы</span>--}}
{{--                                        <span class="badge badge-ghost">❤️ 211</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="join flex justify-center mt-2">--}}
{{--                            <button class="join-item btn btn-sm">1</button>--}}
{{--                            <button class="join-item btn btn-sm btn-active">2</button>--}}
{{--                            <button class="join-item btn btn-sm">3</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="px-6 py-4 border-t text-xs opacity-60 flex justify-between" style="border-color: oklch(86% 0.022 252.894);">--}}
{{--                <span>© Профиль пользователя</span>--}}
{{--                <span>⚡ Активен сегодня</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        (function() {--}}
{{--            const tabButtons = document.querySelectorAll('.tab-btn');--}}
{{--            const contents = {--}}
{{--                profile: document.getElementById('profileTab'),--}}
{{--                animal: document.getElementById('animalTab'),--}}
{{--                edit: document.getElementById('editTab'),--}}
{{--                articles: document.getElementById('articlesTab')--}}
{{--            };--}}
{{--            function activateTab(tabId) {--}}
{{--                Object.values(contents).forEach(content => {--}}
{{--                    if (content) content.classList.add('hidden');--}}
{{--                });--}}
{{--                if (contents[tabId]) contents[tabId].classList.remove('hidden');--}}
{{--                tabButtons.forEach(btn => {--}}
{{--                    const btnTab = btn.getAttribute('data-tab');--}}
{{--                    if (btnTab === tabId) {--}}
{{--                        btn.classList.add('border-b-2', 'border-primary', 'text-primary', 'font-semibold');--}}
{{--                        btn.classList.remove('border-transparent', 'hover:bg-base-200');--}}
{{--                        btn.style.borderBottomColor = '#4976F0';--}}
{{--                        btn.style.color = '#4976F0';--}}
{{--                    } else {--}}
{{--                        btn.classList.remove('border-b-2', 'border-primary', 'text-primary', 'font-semibold');--}}
{{--                        btn.classList.add('border-transparent');--}}
{{--                        btn.style.borderBottomColor = 'transparent';--}}
{{--                        btn.style.color = 'oklch(27.807% 0.029 256.847)';--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--            tabButtons.forEach(btn => {--}}
{{--                btn.addEventListener('click', (e) => {--}}
{{--                    const tabId = btn.getAttribute('data-tab');--}}
{{--                    if (tabId && contents[tabId]) activateTab(tabId);--}}
{{--                });--}}
{{--            });--}}
{{--            activateTab('profile');--}}
{{--        })();--}}
{{--    </script>--}}

            <!-- name of each tab group should be unique -->
            <!-- name of each tab group should be unique -->
            <div class="tabs  p-6">
                <input type="radio" name="my_tabs_6" class="tab" aria-label="Tab 1" checked="checked" />

                <div id="profileTab" class="tab-content transition-all duration-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2 space-y-5">
                            <div class="card bg-base-200 rounded-box p-5" style="background: oklch(100% 0 0); box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                <h3 class="text-xl font-semibold mb-3" style="color: oklch(27.807% 0.029 256.847);">О себе</h3>
                                <p class="leading-relaxed" style="color: oklch(27.807% 0.029 256.847); opacity: 0.8;">{{ $about?->description ?? 'Расскажите немного о себе' }}</p>
                                <div class="divider my-2"></div>
                                <div class="flex flex-wrap gap-4 text-sm">
                                    <div><span class="font-semibold">📍 Локация:</span> {{ $about?->city ?? 'Не указан' }}</div>
                                    <div><span class="font-semibold">🌐 Контакты:</span> <a href="#" class="link link-primary" style="color: #4976F0;">{{ $about?->contact ?? 'Не указано' }}</a></div>
                                    <div><span class="font-semibold">📧 Email:</span> {{ auth()->user()?->email ?? 'Не указано' }}</div>
                                </div>
                            </div>
                            <div class="card bg-base-200 rounded-box p-5" style="background: oklch(100% 0 0);">
                                <h3 class="text-xl font-semibold mb-3">Интересы</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge badge-outline" style="border-color: #4E8EA2; color: #4E8EA2;">{{ $about?->interests ?? 'Не указано' }}</span>

                                </div>
                            </div>
                            <div class="card bg-base-200 rounded-box p-5 -mt-4" style="background: oklch(100% 0 0);">
                                <h3 class="text-xl font-semibold mb-3">Ваши животные</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge badge-outline" style="border-color: #4E8EA2; color: #4E8EA2;">{{ $about?->animal->name ?? 'Не указано' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-5">
                            <div class="card bg-base-200 rounded-box p-5 text-center" style="background: oklch(96% 0.003 264.542);">
                                <div class="stat">
                                    <div class="stat-title">Статьи</div>
                                    <div class="stat-value text-primary" style="color: #4976F0;">24</div>
                                    <div class="stat-desc">за последний год</div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Просмотры</div>
                                    <div class="stat-value text-accent" style="color: #4E8EA2;">12.4K</div>
                                    <div class="stat-desc">⭐ 98% позитивных</div>
                                </div>
                            </div>
                            <button id="openModalBtn" class="btn w-full" style="background: #4976F0; color: white; border: none; padding: 12px 24px; border-radius: 1rem;">
                                ✏️ Заполнить профиль
                            </button>
                            @include('profile.partials.modalCreate')
                        </div>
                    </div>
                </div>
                <input type="radio" name="my_tabs_6" class="tab" aria-label="Tab 2"  />
                <div id="profileTab" class="tab-content bg-base-100 border-base-300 p-6">
                    <div class="p-6 bg-[#f5f6fa]">

                    <div class="max-w-3xl mx-auto">

                        <!-- Заголовок вкладки -->
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-[#1a1d23]">Ваши животные</h2>
                            <button onclick="add_modal.showModal()"
                                    class="btn btn-sm text-white rounded-xl px-5 gap-2 bg-[#4976F0] border-[#4976F0] hover:bg-[#3c5fd0] hover:border-[#3c5fd0]">
                                + Добавить животное
                            </button>
                            @include('profile.partials.modalCreateAnimal')
                        </div>

                        <!-- Сетка карточек животных -->
                        <div id="animals-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- Карточка 1 -->
                            <div class="card bg-white border border-[#e8eaf0] rounded-2xl overflow-hidden hover:shadow-lg hover:border-[#c5d2f8] transition-all">
                                <!-- Карусель DaisyUI -->
                                <div class="carousel w-full rounded-t-2xl">
                                    <div id="slide1-1" class="carousel-item relative w-full">
                                        <img src="{{ asset('img/img_2.png') }}" class="w-full aspect-[4/3] object-cover" alt="фото" />
                                        <div class="absolute flex justify-between transform -translate-y-1/2 left-3 right-3 top-1/2">
                                            <a href="#slide1-3" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❮</a>
                                            <a href="#slide1-2" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❯</a>
                                        </div>
                                    </div>
                                    <div id="slide1-2" class="carousel-item relative w-full">
                                        <img src="{{ asset('img/img_1.png') }}" class="w-full aspect-[4/3] object-cover" alt="фото" />
                                        <div class="absolute flex justify-between transform -translate-y-1/2 left-3 right-3 top-1/2">
                                            <a href="#slide1-1" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❮</a>
                                            <a href="#slide1-3" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❯</a>
                                        </div>
                                    </div>
                                    <div id="slide1-3" class="carousel-item relative w-full">
                                        <img src="{{ asset('img/img.png') }}" class="w-full aspect-[4/3] object-cover" alt="фото" />
                                        <div class="absolute flex justify-between transform -translate-y-1/2 left-3 right-3 top-1/2">
                                            <a href="#slide1-2" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❮</a>
                                            <a href="#slide1-1" class="btn btn-circle btn-sm bg-white/90 border-none shadow-md text-[#4976F0] hover:bg-white">❯</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Инфо -->
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="font-bold text-base text-gray-800">Бобик</span>
                                        <span class="badge bg-[#eef3ff] text-[#4976F0] border border-[#c5d2f8] text-xs font-semibold px-3 py-1">🏠 Домашнее</span>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 py-2 border-b border-[#f0f1f5] text-sm text-[#4b5263]">
                                            <span class="text-xs text-[#9ca3af] min-w-[90px]">Вид</span>
                                            <span>🐶 Собака (Лабрадор)</span>
                                        </div>
                                        <div class="flex items-center gap-2 py-2 border-b border-[#f0f1f5] text-sm text-[#4b5263]">
                                            <span class="text-xs text-[#9ca3af] min-w-[90px]">Возраст</span>
                                            <span>3 года</span>
                                        </div>
                                        <div class="flex items-center gap-2 py-2 text-sm text-[#4b5263]">
                                            <span class="text-xs text-[#9ca3af] min-w-[90px]">История</span>
                                            <span class="text-gray-500 text-sm leading-relaxed">Подобрали щенком у подъезда, вырос в большого и доброго пса.</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-xs btn-ghost text-red-400 mt-3 hover:bg-red-50 rounded-lg">🗑 Удалить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="radio" name="my_tabs_6" class="tab" aria-label="Tab 3" />
                <div class="tab-content bg-base-100 border-base-300 p-6">Tab content 3</div>

@endsection
