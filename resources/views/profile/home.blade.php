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


                <input type="radio" name="my_tabs_6" class="tab" aria-label="Tab 2" />
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
                            @if(\App\Models\Animal::all()->isEmpty())
                                <div class="alert">Вы еще не добавили животное</div>
                            @else
                                <!-- Сетка карточек животных -->
                                <div id="animals-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    @foreach(\App\Models\Animal::all() as $s)
                                        <!-- Карточка животного -->
                                        <div class="card bg-white border border-[#e8eaf0] rounded-2xl overflow-hidden hover:shadow-lg hover:border-[#c5d2f8] transition-all">

                                            <!-- Фото -->
                                            <figure class="w-full aspect-[4/3] overflow-hidden">
                                                <img
                                                    src="{{ $s->picture ? asset('storage/' . ltrim($s->picture, '/')) : 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . urlencode($s->name) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="Фото {{ $s->name }}"
                                                    onerror="this.src='https://api.dicebear.com/9.x/adventurer/svg?seed={{ urlencode($s->name) }}'"
                                                />
                                            </figure>

                                            <!-- Инфо -->
                                            <div class="p-4">
                                                <div class="flex items-center justify-between mb-3">
                                                    <span class="font-bold text-base text-gray-800">{{ $s->name }}</span>
                                                    <span class="badge bg-[#eef3ff] text-[#4976F0] border border-[#c5d2f8] text-xs font-semibold px-3 py-1">
                                    {{ $s->status_animal->name ?? '—' }}
                                </span>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2 py-2 border-b border-[#f0f1f5] text-sm text-[#4b5263]">
                                                        <span class="text-xs text-[#9ca3af] min-w-[90px]">Вид</span>
                                                        <span>{{ $s->view ?? '—' }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2 py-2 border-b border-[#f0f1f5] text-sm text-[#4b5263]">
                                                        <span class="text-xs text-[#9ca3af] min-w-[90px]">Возраст</span>
                                                        <span>{{ $s->age ?? '—' }}</span>
                                                    </div>
                                                    <div class="flex items-start gap-2 py-2 text-sm text-[#4b5263]">
                                                        <span class="text-xs text-[#9ca3af] min-w-[90px] mt-0.5">История</span>
                                                        <span class="text-gray-500 text-sm leading-relaxed">{{ $s->description ?? '—' }}</span>
                                                    </div>
                                                </div>
                                                <!-- Кнопка удалить -->
{{--                                                <form method="POST" action="{{ route('animals.destroy', $s->id) }}"--}}
{{--                                                      onsubmit="return confirm('Удалить животное {{ $s->name }}?')">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit"--}}
{{--                                                            class="btn btn-xs btn-ghost text-red-400 mt-3 hover:bg-red-50 rounded-lg">--}}
{{--                                                        🗑 Удалить--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>


                <input type="radio" name="my_tabs_6" class="tab" aria-label="Tab 3"  />
                <div id="profileTab" class="tab-content transition-all duration-200">kasjdfsdjkf</div>
@endsection
