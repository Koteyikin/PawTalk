@extends('layouts.main')
@section('title', 'Статьи')
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
            --color-accent: #4E8EA2;
            --color-neutral: oklch(27.807% 0.029 256.847);
            --color-neutral-content: oklch(85.561% 0.005 256.847);
            --color-info: #7BBDE8;
            --color-success: #10B981;
            --color-warning: #F59E0B;
            --color-error: #EF4444;
            --radius-box: 1rem;
            --custom: #545871;
        }

        body { font-family: 'Manrope', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease both; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.10s; }
        .delay-3 { animation-delay: 0.15s; }
        .delay-4 { animation-delay: 0.20s; }
        .delay-5 { animation-delay: 0.25s; }
        .delay-6 { animation-delay: 0.30s; }

        /* Featured card gradient overlay */
        .featured-overlay {
            background: linear-gradient(to top, rgba(26,29,35,0.92) 0%, rgba(26,29,35,0.5) 50%, transparent 100%);
        }

        /* Article card left accent */
        .article-card { position: relative; }
        .article-card::before {
            content: '';
            position: absolute;
            left: 0; top: 16px; bottom: 16px;
            width: 3px;
            border-radius: 2px;
            background: var(--accent-color, #4976F0);
            opacity: 0;
            transition: opacity 0.25s;
        }
        .article-card:hover::before { opacity: 1; }

        /* Search input focus ring */
        .search-input:focus { outline: none; border-color: #4976F0; box-shadow: 0 0 0 3px rgba(73,118,240,0.15); }

        /* Active filter badge */
        .filter-active {
            background: #4976F0 !important;
            color: #fff !important;
            border-color: #4976F0 !important;
        }

        /* Pagination active */
        .page-active {
            background: #4976F0;
            color: #fff;
            border-color: #4976F0;
        }
    </style>
</head>
<body class="bg-base-100 text-base-content overflow-x-hidden">

{{-- ══════════════════════════════ --}}
{{--  NAVBAR                        --}}
{{-- ══════════════════════════════ --}}


{{-- ══════════════════════════════ --}}
{{--  PAGE HERO HEADER              --}}
{{-- ══════════════════════════════ --}}
<div class="relative overflow-hidden py-16 px-6" style="background-color: var(--custom);">
    {{-- BG blobs --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background: radial-gradient(ellipse 50% 80% at 10% 50%, rgba(73,118,240,0.2) 0%, transparent 70%),
                            radial-gradient(ellipse 40% 60% at 90% 30%, rgba(78,142,162,0.18) 0%, transparent 70%);">
    </div>
    {{-- Decorative paws --}}
    <span class="absolute text-6xl opacity-[0.04] right-16 top-4 rotate-12">🐾</span>
    <span class="absolute text-9xl opacity-[0.03] left-8 bottom-0 -rotate-12">🐾</span>

    <div class="max-w-5xl mx-auto relative z-10">
        {{-- Breadcrumbs --}}
        <div class="breadcrumbs text-xs text-white/40 mb-6">
            <ul>
                <li><a href="{{ route('home.index') }}" class="hover:text-white/70">Главная</a></li>
                <li class="text-white/60">Статьи</li>
            </ul>
        </div>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <p class="text-info text-xs font-bold uppercase tracking-[0.14em] mb-3">База знаний сообщества</p>
                <h1 class="font-display text-4xl md:text-5xl font-black text-white leading-tight mb-3">
                    Статьи и обсуждения
                </h1>
                <p class="text-white/55 text-sm leading-relaxed max-w-lg">
                    Экспертные материалы, личный опыт и советы от тысяч владельцев животных.
                    Находите нужное, делитесь своим.
                </p>
            </div>
            <a href="#" onclick="article_modal.showModal()"
               class="btn btn-primary rounded-full px-7 text-white border-none shadow-xl flex-shrink-0 hover:-translate-y-1 transition-transform">
                ✏️ Написать статью
            </a>
            @include('articles.partials.modalCreateArticles')
        </div>

        {{-- Quick stats --}}
        <div class="flex gap-6 mt-10 flex-wrap">
            <div class="text-center">
                <div class="font-display text-2xl font-bold text-white">5 234</div>
                <div class="text-white/40 text-xs uppercase tracking-wide">Статей</div>
            </div>
            <div class="w-px bg-white/15 self-stretch"></div>
            <div class="text-center">
                <div class="font-display text-2xl font-bold text-white">1 820</div>
                <div class="text-white/40 text-xs uppercase tracking-wide">Авторов</div>
            </div>
            <div class="w-px bg-white/15 self-stretch"></div>
            <div class="text-center">
                <div class="font-display text-2xl font-bold text-white">48K</div>
                <div class="text-white/40 text-xs uppercase tracking-wide">Прочтений</div>
            </div>
        </div>
    </div>
</div>


{{-- ══════════════════════════════ --}}
{{--  FEATURED ARTICLE              --}}
{{-- ══════════════════════════════ --}}
<div class="bg-base-200 px-6 py-10 border-b border-base-300">
    <div class="max-w-5xl mx-auto">
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-primary mb-5">⭐ Статья недели</p>

        <a href="#"
           class="card bg-neutral overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="relative min-h-64 md:min-h-80">
                {{-- Placeholder image via gradient --}}
                <div class="absolute inset-0"
                     style="background: linear-gradient(135deg, #3a4a7a 0%, #2a3a6a 30%, #1a2a5a 100%);">
                    {{-- Abstract pet silhouette --}}
                    <div class="absolute inset-0 flex items-center justify-center opacity-10">
                        <span style="font-size: 12rem; line-height:1;">🐕</span>
                    </div>
                </div>

                {{-- Overlay --}}
                <div class="featured-overlay absolute inset-0"></div>

                {{-- Content over image --}}
                <div class="absolute bottom-0 left-0 right-0 p-8 z-10">
                    <div class="flex items-center gap-3 mb-4 flex-wrap">
                        <div class="badge badge-primary text-white border-none text-xs font-bold">Питание</div>
                        <div class="badge bg-white/15 text-white border-none text-xs">15 мин чтения</div>
                    </div>
                    <h2 class="font-display text-2xl md:text-3xl font-bold text-white leading-tight mb-3
                               group-hover:text-info transition-colors">
                        Полное руководство по питанию собак: от щенка до пожилого пса
                    </h2>
                    <p class="text-white/65 text-sm leading-relaxed mb-5 max-w-2xl line-clamp-2">
                        Исчерпывающее руководство, которое охватывает все этапы жизни вашей собаки. Узнайте,
                        как правильно кормить щенка, взрослого пса и пожилую собаку, какие продукты под запретом
                        и как читать состав корма.
                    </p>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <div class="avatar placeholder">
                                <div class="w-9 h-9 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">МС</div>
                            </div>
                            <div>
                                <div class="text-white text-sm font-semibold">Михаил Семёнов</div>
                                <div class="text-white/40 text-xs">14 апреля 2025</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 ml-auto text-white/50 text-xs">
                            <span>❤️ 312</span>
                            <span>💬 87</span>
                            <span>👁 14.2K</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>


{{-- ══════════════════════════════ --}}
{{--  FILTER & SEARCH               --}}
{{-- ══════════════════════════════ --}}
<div class="bg-base-200 px-6 py-5 border-b border-base-300 sticky top-16 z-40 shadow-sm">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">

        {{-- Category filters --}}
        <div class="flex gap-2 flex-wrap">
            <button class="badge badge-outline filter-active cursor-pointer px-4 py-3 text-xs font-semibold transition-all">Все</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🐱 Кошки</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🐶 Собаки</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🐰 Грызуны</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🦜 Птицы</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🏥 Здоровье</button>
            <button class="badge badge-ghost cursor-pointer px-4 py-3 text-xs font-semibold hover:badge-primary transition-all">🥗 Питание</button>
        </div>

        {{-- Search --}}
        <div class="relative flex-shrink-0">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/30 text-sm">🔍</span>
            <input type="text" placeholder="Поиск статей..."
                   class="search-input input input-sm bg-base-100 border border-base-300 rounded-full pl-9 pr-4 w-56
                          text-sm transition-all" />
        </div>
    </div>
</div>


{{-- ══════════════════════════════ --}}
{{--  ARTICLES GRID                 --}}
{{-- ══════════════════════════════ --}}
<section class="py-12 px-6 bg-base-100">
    <div class="max-w-5xl mx-auto">

        {{-- Sort & count row --}}
        <div class="flex items-center justify-between mb-8">
            <p class="text-sm text-base-content/50">
                Найдено <span class="font-semibold text-base-content">5 234</span> статей
            </p>
            <select class="select select-sm bg-base-200 border border-base-300 rounded-full text-sm">
                <option>Сначала новые</option>
                <option>Сначала популярные</option>
                <option>По комментариям</option>
            </select>
        </div>

        {{-- ── ARTICLES LIST ── --}}
        {{-- В реальном проекте: @foreach($articles as $article) ... @endforeach --}}

        <div class="flex flex-col gap-5">

            {{-- Article 1 --}}
            @forelse(\App\Models\Article::all() as $s)

            <a href="{{ route('articles.show', $s->id) }}"
               class="card bg-base-200 border border-base-300 overflow-hidden article-card
                      hover:shadow-lg hover:border-primary/30 hover:bg-base-200 transition-all duration-250
                      animate-fade-up delay-1 group"
               style="--accent-color: #4976F0;">
                <div class="card-body p-0 flex flex-row items-stretch gap-0">

                    {{-- Color stripe --}}
                    <div class="w-1 bg-primary flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity rounded-l-2xl"></div>

                    {{-- Thumbnail placeholder --}}
                    <div class="w-36 md:w-48 flex-shrink-0 relative overflow-hidden"
                         style="background: linear-gradient(135deg, #eef3ff 0%, #dce8ff 100%);">
                        <span class="absolute inset-0 flex items-center justify-center text-5xl opacity-30">🐱</span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 p-5 flex flex-col gap-2">
                        <div class="flex items-center gap-2 flex-wrap">
                            <div class="badge badge-soft badge-primary text-xs font-bold">
                                @foreach($s->tags as $tag)
                                    <span>{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <span class="text-xs text-base-content/40">{{ $s->reading_time }} мин чтения</span>
                            <span class="text-xs text-base-content/40 ml-auto">2 часа назад</span>
                        </div>
                        <h3 class="font-display text-lg font-bold text-neutral leading-snug group-hover:text-primary transition-colors">
                            {{ $s->title }}
                        </h3>
                        <p class="text-sm text-base-content/60 leading-relaxed line-clamp-2">
                            {{ $s->excerpt }}
                        </p>
                        <div class="flex items-center gap-3 mt-auto pt-3 border-t border-base-300">
                            <div class="avatar placeholder">
                                <div class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">АК</div>
                            </div>

                            <span class="text-xs font-semibold text-neutral">{{ $s->author->aboutUser->name }} {{ $s->author->aboutUser->surname  }} </span>
                            <div class="flex items-center gap-3 ml-auto text-xs text-base-content/40">
                                <span>❤️ 48</span>
                                <span>💬 12</span>
                                <span>👁 320</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
                <div class="text-center">Еще никто не добавил никакой статьи</div>
            @endforelse
        </div>{{-- end articles list --}}


        {{-- ══════════════════════════════ --}}
        {{--  PAGINATION                    --}}
        {{-- ══════════════════════════════ --}}
        {{--
            В реальном проекте замените этот блок на:
            {{ $articles->links('vendor.pagination.petspace') }}
            или стандартный: {{ $articles->links() }}
        --}}
        <div class="flex justify-center items-center gap-2 mt-14 flex-wrap">

            {{-- Prev --}}
            <a href="#" class="btn btn-sm btn-ghost rounded-full border border-base-300 text-base-content/50
                               hover:border-primary hover:text-primary transition-all">
                ← Назад
            </a>

            {{-- Pages --}}
            <a href="#" class="btn btn-sm rounded-full border border-base-300 text-base-content/60
                               hover:border-primary hover:text-primary transition-all">1</a>

            <a href="#" class="btn btn-sm rounded-full border-none text-white shadow-md transition-all"
               style="background:#4976F0;">2</a>

            <a href="#" class="btn btn-sm rounded-full border border-base-300 text-base-content/60
                               hover:border-primary hover:text-primary transition-all">3</a>

            <a href="#" class="btn btn-sm rounded-full border border-base-300 text-base-content/60
                               hover:border-primary hover:text-primary transition-all">4</a>

            <a href="#" class="btn btn-sm rounded-full border border-base-300 text-base-content/60
                               hover:border-primary hover:text-primary transition-all">5</a>

            <span class="btn btn-sm btn-ghost rounded-full border border-base-300 cursor-default text-base-content/30">…</span>

            <a href="#" class="btn btn-sm rounded-full border border-base-300 text-base-content/60
                               hover:border-primary hover:text-primary transition-all">47</a>

            {{-- Next --}}
            <a href="#" class="btn btn-sm btn-ghost rounded-full border border-base-300 text-base-content/50
                               hover:border-primary hover:text-primary transition-all">
                Вперёд →
            </a>
        </div>

        {{-- Page info --}}
        <p class="text-center text-xs text-base-content/35 mt-4">
            Страница 2 из 47 · Показано 6 из 5 234 статей
        </p>

    </div>
</section>


{{-- ══════════════════════════════ --}}
{{--  FOOTER                        --}}
{{-- ══════════════════════════════ --}}
<footer class="py-6 px-10 bg-neutral">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3">
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
