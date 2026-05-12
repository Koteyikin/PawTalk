@php use App\Models\User; @endphp
@extends('layouts.main')
@section('title', 'Главная страничка')
@section('body')
    <style>
        :root {
            --color-base-100: oklch(96% 0.003 264.542);
            --color-base-200: oklch(100% 0 0);
            --color-base-300: oklch(86% 0.022 252.894);
            --color-base-content: oklch(27.807% 0.029 256.847);
            --color-primary: #4976F0;
            --color-primary-content: #e3cee4;
            --color-secondary: oklch(39.9% 0.214 241.360);
            --color-secondary-content: oklch(90.784% 0.032 241.36);
            --color-accent: #4E8EA2;
            --color-accent-content: oklch(15.196% 0.04 56.72);
            --color-neutral: oklch(27.807% 0.029 256.847);
            --color-neutral-content: oklch(85.561% 0.005 256.847);
            --color-info: #7BBDE8;
            --color-success: #10B981;
            --color-warning: #F59E0B;
            --color-error: #EF4444;
            --radius-selector: 1rem;
            --radius-field: 1rem;
            --radius-box: 1rem;
            --border: 0.5px;
            --custom: #545871;
            --font-display: 'Playfair Display', serif;
            --font-body: 'Manrope', sans-serif;
        }


        /* Floating paw animation */
        @keyframes floatPaw {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-12px) rotate(8deg); }
        }
        .paw-float { animation: floatPaw 6s ease-in-out infinite; }
        .paw-float:nth-child(2) { animation-delay: 1s; }
        .paw-float:nth-child(3) { animation-delay: 2s; }
        .paw-float:nth-child(4) { animation-delay: 0.5s; }
        .paw-float:nth-child(5) { animation-delay: 3s; }
        .paw-float:nth-child(6) { animation-delay: 1.5s; }

        /* Fade up entrance */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.7s ease both; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        /* Hero entrance */
        @keyframes heroIn {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-hero { animation: heroIn 0.9s ease both; }

        /* Feature card top border reveal */
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 1rem 1rem 0 0;
            background:  #4976F0;
            opacity: 0;
            transition: opacity 0.25s;
        }
        .feature-card:hover::before { opacity: 1; }

        /* Post card left border */
        .post-card-border {
            width: 4px;
            border-radius: 1rem 0 0 1rem;
            flex-shrink: 0;
        }

        /* CTA background circles */
        .cta-blob::before {
            content: '';
            position: absolute;
            right: -60px; top: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(73,118,240,0.15);
            pointer-events: none;
        }
        .cta-blob::after {
            content: '';
            position: absolute;
            right: 80px; bottom: -80px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(78,142,162,0.15);
            pointer-events: none;
        }
    </style>
    </head>
    <body class="bg-base-100 text-base-content overflow-x-hidden">


    {{-- ══════════════════════════════════════════ --}}
    {{--  HERO                                       --}}
    {{-- ══════════════════════════════════════════ --}}
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden"
             style="background-color: var(--custom);">

        {{-- Radial gradient overlays --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0"
                 style="background: radial-gradient(ellipse 60% 50% at 20% 80%, rgba(73,118,240,0.25) 0%, transparent 70%),
                                radial-gradient(ellipse 50% 60% at 80% 20%, rgba(78,142,162,0.2) 0%, transparent 70%);">
            </div>
        </div>

        {{-- Floating paws --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <span class="paw-float absolute text-5xl opacity-5 top-[10%] left-[8%]">🐾</span>
            <span class="paw-float absolute text-2xl opacity-5 top-[25%] right-[12%]">🐾</span>
            <span class="paw-float absolute text-4xl opacity-5 bottom-[20%] left-[15%]">🐾</span>
            <span class="paw-float absolute text-3xl opacity-5 bottom-[35%] right-[8%]">🐾</span>
            <span class="paw-float absolute text-xl opacity-5 top-[55%] left-[5%]">🐾</span>
            <span class="paw-float absolute text-4xl opacity-5 top-[70%] right-[20%]">🐾</span>
        </div>



        {{-- Hero content --}}
        <div class="relative z-10 text-center max-w-2xl px-8 mt-8 animate-hero">
            <div class="badge badge-outline border-[#4976F0]/50 text-[#a8c0ff] bg-[#4976F0]/20 mb-6 px-4 py-3 text-xs font-bold uppercase tracking-widest">
                Социальная сеть для владельцев животных
            </div>

            <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-5">
                Место, где живут<br>
                <span class="text-info">любимые питомцы</span>
            </h1>

            <p class="text-white/60 text-lg font-light leading-relaxed mb-10 max-w-lg mx-auto">
                Делитесь историями, находите советы и общайтесь с такими же любящими хозяевами. Ваш питомец заслуживает лучшего сообщества.
            </p>

            <div class="flex gap-4 justify-center flex-wrap">
                <a href="#" class="btn btn-primary rounded-full px-8 text-white border-none shadow-xl hover:-translate-y-1 transition-transform">
                    Создать профиль
                </a>
                <a href="#articles" class="btn btn-outline rounded-full px-8 text-white border-white/25 hover:bg-white/10 hover:border-white/50 hover:text-white">
                    Смотреть статьи
                </a>
            </div>
        </div>

        {{-- Bottom stats --}}
    </section>


    {{-- ══════════════════════════════════════════ --}}
    {{--  FEATURES                                   --}}
    {{-- ══════════════════════════════════════════ --}}
    <section class="py-24 px-6 bg-base-200">
        <div class="max-w-5xl mx-auto">

            {{-- Section header --}}
            <div class="mb-14">
                <p class="text-primary text-xs font-bold uppercase tracking-[0.14em] mb-2">Возможности платформы</p>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-neutral leading-tight mb-4">
                    Всё для вашего питомца<br>в одном месте
                </h2>
                <p class="text-base-content/60 text-base font-light leading-relaxed max-w-lg">
                    От личного профиля до экспертных статей — пространство, где каждый владелец чувствует себя частью семьи.
                </p>
            </div>

            {{-- Cards grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Profile card --}}
                <div class="card bg-base-100 border border-base-300 shadow-sm relative overflow-hidden feature-card
                        hover:-translate-y-2 hover:shadow-xl transition-all duration-300 animate-fade-up delay-100"
                     style="--card-accent: #4976F0;">
                    <div class="card-body gap-4">
                        <div class="badge badge-soft badge-primary text-xs font-bold uppercase tracking-wide w-fit">
                            Личный кабинет
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-2xl">👤</div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-neutral mb-2">Ваш профиль</h3>
                            <p class="text-sm text-base-content/60 leading-relaxed mb-4">
                                Создайте страницу для себя и каждого питомца. Загружайте фото, отслеживайте здоровье и делитесь историями.
                            </p>
                        </div>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>
                                Карточки всех ваших животных
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>
                                Редактирование данных и фото
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>
                                История активности и постов
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>
                                Личные настройки аккаунта
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Articles card --}}
                <div class="card bg-base-100 border border-base-300 shadow-sm relative overflow-hidden feature-card
                        hover:-translate-y-2 hover:shadow-xl transition-all duration-300 animate-fade-up delay-200"
                     style="--card-accent: #4E8EA2;">
                    <div class="card-body gap-4">
                        <div class="badge badge-soft badge-accent text-xs font-bold uppercase tracking-wide w-fit">
                            Сообщество
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center text-2xl">📰</div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-neutral mb-2">Статьи и обсуждения</h3>
                            <p class="text-sm text-base-content/60 leading-relaxed mb-4">
                                Читайте экспертные материалы о здоровье, уходе и воспитании животных. Делитесь опытом и задавайте вопросы.
                            </p>
                        </div>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent flex-shrink-0"></span>
                                Авторские статьи и советы
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent flex-shrink-0"></span>
                                Тематические обсуждения
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent flex-shrink-0"></span>
                                Комментарии и реакции
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent flex-shrink-0"></span>
                                Лента по интересам
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Admin card --}}
                <div class="card bg-base-100 border border-base-300 shadow-sm relative overflow-hidden feature-card
                        hover:-translate-y-2 hover:shadow-xl transition-all duration-300 animate-fade-up delay-300"
                     style="--card-accent: #EF4444;">
                    <div class="card-body gap-4">
                        <div class="badge badge-soft badge-error text-xs font-bold uppercase tracking-wide w-fit">
                            Только для избранных
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-error/10 flex items-center justify-center text-2xl">🔐</div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-neutral mb-2">Расширенные функции</h3>
                            <p class="text-sm text-base-content/60 leading-relaxed mb-4">
                                Особые инструменты для администраторов и модераторов. Управляйте платформой и помогайте сообществу.
                            </p>
                        </div>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-error flex-shrink-0"></span>
                                Панель управления контентом
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-error flex-shrink-0"></span>
                                Модерация пользователей
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-error flex-shrink-0"></span>
                                Аналитика и статистика
                            </li>
                            <li class="flex items-center gap-2 text-sm text-base-content/70">
                                <span class="w-1.5 h-1.5 rounded-full bg-error flex-shrink-0"></span>
                                Системные настройки
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════════ --}}
    {{--  ACTIVITY FEED                              --}}
    {{-- ══════════════════════════════════════════ --}}
    <section id="articles" class="py-24 px-6 bg-base-100">
        <div class="max-w-5xl mx-auto">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">

                {{-- Main feed --}}
                <div class="lg:col-span-3">
                    <p class="text-primary text-xs font-bold uppercase tracking-[0.14em] mb-2">Лента активностей</p>
                    <h2 class="font-display text-4xl font-bold text-neutral mb-2 leading-tight">Последние статьи</h2>
                    <p class="text-base-content/60 text-sm leading-relaxed mb-8">Свежие материалы от нашего сообщества</p>
                    @foreach(\App\Models\Article::where('status', 'published')->latest()->take(3)->get() as $s)
                        <div class="card bg-base-200 border border-base-300 mb-4 overflow-hidden
                            hover:translate-x-1 hover:shadow-md transition-all duration-200 flex flex-row">
                            <div class="post-card-border" style="background:#4976F0;"></div>
                            <div class="card-body p-5 gap-3">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <div class="avatar placeholder">
                                        <div class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">АК</div>
                                    </div>
                                    <span class="text-sm font-semibold text-neutral">{{ $s->author->aboutUser->name }} {{ $s->author->aboutUser->surname }}</span>
                                    <div class="badge badge-soft badge-primary text-xs">{{ $s->tag }}</div>
                                    <span class="text-xs text-base-content/40 ml-auto">2 часа назад</span>
                                </div>
                                <h4 class="font-display text-base font-bold text-neutral leading-snug">{{ $s->title }}</h4>
                                <p class="text-sm text-base-content/60 leading-relaxed line-clamp-2">{{ $s->excerpt }}</p>
                                <div class="flex items-center gap-4 pt-2 border-t border-base-300 text-xs text-base-content/40">
                                    <span>❤️ {{ $s->likes()->count() }}</span>
                                    <span>💬 {{ $s->comments_count }}</span>
                                    <span>👁 {{ $s->reding_time }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('articles.index') }}"
                       class="btn btn-outline btn-primary rounded-full px-8 hover:shadow-lg">
                        Все статьи →
                    </a>
                </div>

                {{-- Aside --}}
                <div class="lg:col-span-2 flex flex-col gap-5">

                    {{-- Tags --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body gap-3">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Популярные темы</h5>
                            <div class="flex flex-wrap gap-2">
                                @foreach(\App\Models\Tag::inRandomOrder()->take(10)->get() as $tag)
                                    <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php
                        $topAuthors = User::with('aboutUser')->withCount('articles')->having('articles_count', '>', 0)->orderBy('articles_count', 'desc')->take(4)->get();
                    @endphp
                    {{-- Top authors --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body gap-3">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Активные авторы</h5>
                            @if($topAuthors->isEmpty())
                                <p class="text-sm text-base-content/40">
                                    Пока нет активных авторов
                                </p>
                            @else
                            @foreach($topAuthors as $index => $author)
                                <div class="flex items-center gap-3 py-2
                                    {{ !$loop->last ? 'border-b border-base-300' : '' }}">
                                    {{-- Avatar --}}
                                    <div class="avatar placeholder">
                                        <div class="w-9 h-9 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">
                                            {{ mb_strtoupper(mb_substr($author->aboutUser->name ?? 'А', 0, 1)) }}
                                        </div>
                                    </div>
                                    {{-- User info --}}
                                    <div class="flex-1">
                                        <div class="text-sm font-semibold text-neutral">
                                            {{ $author->aboutUser->name ?? '—' }}
                                            {{ $author->aboutUser->surname ?? '' }}
                                        </div>
                                        <div class="text-xs text-base-content/40">
                                            {{ $author->articles_count }} статей
                                        </div>
                                    </div>

                                    {{-- Rank --}}
                                    <span class="text-sm font-bold text-primary">
                                        #{{ $index + 1 }}
                                    </span>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- CTA mini --}}
                    <div class="card border border-primary/20" style="background: linear-gradient(135deg, #eef3ff 0%, #f0f8ff 100%);">
                        <div class="card-body gap-3">
                            <span class="text-3xl">🐾</span>
                            <h5 class="font-display font-bold text-neutral text-base">У вас ещё нет питомца на сайте?</h5>
                            <p class="text-sm text-base-content/60 leading-relaxed">Добавьте карточку питомца и присоединяйтесь к сообществу!</p>
                            <a href="{{ route('profile.index') }}" class="btn btn-primary btn-sm rounded-full w-fit">
                                Добавить питомца
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════════ --}}
    {{--  STATS                                      --}}
    {{-- ══════════════════════════════════════════ --}}
    <section class="py-24 px-6" style="background-color: var(--custom);">
        <div class="max-w-5xl mx-auto">

            <p class="text-info text-xs font-bold uppercase tracking-[0.14em] mb-2">Цифры говорят сами за себя</p>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-3 leading-tight">
                Наше сообщество растёт
            </h2>
            <p class="text-white/55 text-sm leading-relaxed max-w-lg mb-14">
                Каждый день к нам присоединяются новые владельцы и их пушистые друзья из разных городов.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach(\App\Models\SiteStat::all() as $stat)

                <div class="card border border-white/10 bg-white/[0.06] hover:bg-white/10 hover:-translate-y-1 transition-all duration-200">
                    <div class="card-body items-center text-center gap-2 p-6">
                        <span class="text-3xl mb-1">👥</span>
                        <div class="font-display text-4xl font-black text-white">{{ $stat->users_count }}</div>
                        <div class="text-white/50 text-xs font-medium leading-snug">Пользователей на сайте</div>
                    </div>
                </div>

                <div class="card border border-white/10 bg-white/[0.06] hover:bg-white/10 hover:-translate-y-1 transition-all duration-200">
                    <div class="card-body items-center text-center gap-2 p-6">
                        <span class="text-3xl mb-1">🐾</span>
                        <div class="font-display text-4xl font-black text-white">{{ $stat->animal_count }}</div>
                        <div class="text-white/50 text-xs font-medium leading-snug">Питомцев зарегистрировано</div>
                    </div>
                </div>

                <div class="card border border-white/10 bg-white/[0.06] hover:bg-white/10 hover:-translate-y-1 transition-all duration-200">
                    <div class="card-body items-center text-center gap-2 p-6">
                        <span class="text-3xl mb-1">📝</span>
                        <div class="font-display text-4xl font-black text-white">{{ $stat->articles_count }}</div>
                        <div class="text-white/50 text-xs font-medium leading-snug">Статей и постов</div>
                    </div>
                </div>

                <div class="card border border-white/10 bg-white/[0.06] hover:bg-white/10 hover:-translate-y-1 transition-all duration-200">
                    <div class="card-body items-center text-center gap-2 p-6">
                        <span class="text-3xl mb-1">🏙️</span>
                        <div class="font-display text-4xl font-black text-white">{{ $stat->cities_count }}</div>
                        <div class="text-white/50 text-xs font-medium leading-snug">Городов-участников</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════════ --}}
    {{--  CTA                                        --}}
    {{-- ══════════════════════════════════════════ --}}
    <section class="py-24 px-6 bg-base-200">
        <div class="max-w-5xl mx-auto">
            <div class="card relative overflow-hidden cta-blob"
                 style="background: linear-gradient(135deg, var(--custom) 0%, #3a3d52 100%);">
                <div class="card-body p-10 md:p-14 flex-col md:flex-row items-start md:items-center gap-10 relative z-10">

                    <div class="flex-1">
                        <p class="text-info text-xs font-bold uppercase tracking-[0.14em] mb-3">Присоединяйтесь к нам</p>
                        <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-3 leading-tight">
                            Станьте частью<br>нашей семьи
                        </h2>
                        <p class="text-white/60 text-sm leading-relaxed max-w-md">
                            Тысячи владельцев уже нашли здесь друзей, советы и поддержку. Зарегистрируйтесь бесплатно и начните делиться историей своего питомца.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 flex-shrink-0 w-full md:w-auto">
                        <div class="join">
                            <input type="email" placeholder="Ваш email..."
                                   class="input join-item bg-white/10 border-white/20 text-white placeholder-white/40
                                      focus:outline-none focus:border-primary min-w-[200px]" />
                            <a href="#"  onclick="my_modal_2.showModal()"
                               class="btn btn-primary join-item border-none text-white">
                                Начать
                            </a>
                        </div>
                        <p class="text-white/35 text-xs text-center">Бесплатно · Без спама · Выход в любой момент</p>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════════ --}}
    {{--  FOOTER                                     --}}
    {{-- ══════════════════════════════════════════ --}}
    <footer class="footer footer-center py-6 px-10 bg-neutral text-neutral-content">
        <div class="flex flex-col md:flex-row items-center justify-between w-full gap-3">
            <span class="font-display text-xl text-white/60">🐾 PetSpace</span>
            <p class="text-white/30 text-xs">© 2025 PetSpace. Все права защищены.</p>
            <div class="flex gap-4 text-xs text-white/30">
                <a href="#" class="hover:text-white/60 transition-colors">Политика конф.</a>
                <a href="#" class="hover:text-white/60 transition-colors">Условия</a>
                <a href="#" class="hover:text-white/60 transition-colors">Контакты</a>
            </div>
        </div>
    </footer>


@endsection
