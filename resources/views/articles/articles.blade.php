@php use App\Models\Article;use App\Models\Tag; @endphp
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

        body {
            font-family: 'Manrope', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.6s ease both;
        }

        .delay-1 {
            animation-delay: 0.05s;
        }

        .delay-2 {
            animation-delay: 0.10s;
        }

        .delay-3 {
            animation-delay: 0.15s;
        }

        .delay-4 {
            animation-delay: 0.20s;
        }

        .delay-5 {
            animation-delay: 0.25s;
        }

        .delay-6 {
            animation-delay: 0.30s;
        }

        /* Featured card gradient overlay */
        .featured-overlay {
            background: linear-gradient(to top, rgba(26, 29, 35, 0.92) 0%, rgba(26, 29, 35, 0.5) 50%, transparent 100%);
        }

        /* Article card left accent */
        .article-card {
            position: relative;
        }

        .article-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 16px;
            bottom: 16px;
            width: 3px;
            border-radius: 2px;
            background: var(--accent-color, #4976F0);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .article-card:hover::before {
            opacity: 1;
        }

        /* Search input focus ring */
        .search-input:focus {
            outline: none;
            border-color: #4976F0;
            box-shadow: 0 0 0 3px rgba(73, 118, 240, 0.15);
        }

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
                @include('articles.partials.modalCreateArticles')
                @if(auth()->user()->profileFull())
                    <a href="#" onclick="article_modal.showModal()"
                       class="btn btn-primary rounded-full px-7 text-white border-none shadow-xl flex-shrink-0 hover:-translate-y-1 transition-transform">
                        ✏️ Написать статью
                    </a>
                @else
                    <a href="#" onclick="noProfile.showModal()"
                       class="btn btn-primary rounded-full px-7 text-white border-none shadow-xl flex-shrink-0 hover:-translate-y-1 transition-transform">
                        ✏️ Написать статью
                    </a>
                @endif
            </div>

            {{-- Quick stats --}}
            <div class="flex gap-6 mt-10 flex-wrap">
                @foreach(\App\Models\SiteStat::all() as $stat)
                    <div class="text-center">
                        <div class="font-display text-2xl font-bold text-white">{{ $stat->articles_count }}</div>
                        <div class="text-white/40 text-xs uppercase tracking-wide">Статей</div>
                    </div>
                    <div class="w-px bg-white/15 self-stretch"></div>
                    <div class="text-center">
                        <div class="font-display text-2xl font-bold text-white">{{ $stat->users_count }}</div>
                        <div class="text-white/40 text-xs uppercase tracking-wide">Авторов</div>
                    </div>
                    <div class="w-px bg-white/15 self-stretch"></div>
                    <div class="text-center">
                        <div class="font-display text-2xl font-bold text-white">{{ $totalViews }}</div>
                        <div class="text-white/40 text-xs uppercase tracking-wide">Прочтений</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════ --}}
    {{--  FEATURED ARTICLE              --}}
    {{-- ══════════════════════════════ --}}
    @forelse(Article::where('is_featured', 1)->get() as $a)
    <div    class="bg-base-200 px-6 py-10 border-b border-base-300">
        <div class="max-w-5xl mx-auto">
            <p class="text-xs font-bold uppercase tracking-[0.14em] text-primary mb-5">⭐ Статья недели</p>

            <a href="{{ route('articles.show', $a->id) }}"
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
                            @foreach($a->tags as $s)
                                <div class="badge badge-primary text-white border-none text-xs font-bold">{{ $s->name }}</div>
                            @endforeach
                            <div class="badge bg-white/15 text-white border-none text-xs">{{ $a->reading_time }} мин. чтения</div>
                        </div>
                        <h2 class="font-display text-2xl md:text-3xl font-bold text-white leading-tight mb-3 group-hover:text-info transition-colors">
                            {{ $a->title }}
                        </h2>
                        <p class="text-white/65 text-sm leading-relaxed mb-5 max-w-2xl line-clamp-2">
                            {{ $a->excerpt }}
                        </p>
                        <div class="flex items-center gap-4 flex-wrap">
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div
                                        class="w-9 h-9 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">
                                        {{ $a?->author->aboutUser->avatar ? asset('storage/' . $a->author->aboutUser->avatar) : 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . auth()->user()->nickname }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-white text-sm font-semibold">{{ $a->author->aboutUser->name }} {{ $a->author->aboutUser->surname }}</div>
                                    <div class="text-white/40 text-xs">{{ $a->created_at }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 ml-auto text-white/50 text-xs">
                                <span>❤️ {{ $a->likes()->count() }}</span>
                                <span>💬 {{ $a->comments_count }}</span>
                                <span>👁 {{ $a->views_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @empty
        <div class="text-center">Еще никто не добавил никакой статьи</div>
    @endforelse


    {{-- ══════════════════════════════ --}}
    {{--  FILTER & SEARCH               --}}
    {{-- ══════════════════════════════ --}}
    <div class="bg-base-200 px-6 py-5 border-b border-base-300 sticky top-16 z-40 shadow-sm">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">

            {{-- Category filters --}}
            <div class="w-full flex gap-2 overflow-x-auto pb-1
            [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                {{-- Кнопка "Все" --}}
                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}"
                   class="badge cursor-pointer px-4 py-3 text-xs font-semibold transition-all flex-shrink-0
              {{ !$categoryId ? 'badge-primary text-white' : 'badge-ghost hover:badge-primary' }}">
                    Все
                </a>
                @foreach(\App\Models\Category::all() as $c)
                    <a href="{{ request()->fullUrlWithQuery(['category' => $c->id]) }}"
                       class="badge cursor-pointer px-4 py-3 text-xs font-semibold transition-all flex-shrink-0
                  {{ $categoryId == $c->id ? 'badge-primary text-white' : 'badge-ghost hover:badge-primary' }}">
                        {{ $c->name }}
                    </a>
                @endforeach
            </div>

            {{-- Search --}}
            <div class="relative flex-shrink-0">
                <form method="GET" action="{{ route('articles.search') }}" class="relative flex-shrink-0">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/30 text-sm">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск статей..." class="search-input input input-sm bg-base-100 border border-base-300 rounded-full pl-9 pr-4 w-56 text-sm transition-all"/>
                </form>
            </div>
        </div>
    </div>


    <section class="py-12 px-6 bg-base-100">
        <div class="max-w-5xl mx-auto">

            <div class="flex justify-center mb-8">
                <div class="flex gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'new']) }}"
                       class="btn btn-sm rounded-full {{ $sort === 'new' ? 'btn-primary text-white' : 'btn-ghost border border-base-300' }}">
                        🕐 Новые
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}"
                       class="btn btn-sm rounded-full {{ $sort === 'popular' ? 'btn-primary text-white' : 'btn-ghost border border-base-300' }}">
                        🔥 Популярные
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'comments']) }}"
                       class="btn btn-sm rounded-full {{ $sort === 'comments' ? 'btn-primary text-white' : 'btn-ghost border border-base-300' }}">
                        💬 По комментариям
                    </a>
                </div>
            </div>


            <div class="flex flex-col gap-5">
            {{--Article--}}
                @forelse($articles as $s)

                    <a href="{{ route('articles.show', $s->id) }}"
                       class="card bg-base-200 border border-base-300 overflow-hidden article-card
                      hover:shadow-lg hover:border-primary/30 hover:bg-base-200 transition-all duration-250
                      animate-fade-up delay-1 group"
                       style="--accent-color: #4976F0;">
                        <div class="card-body p-0 flex flex-row items-stretch gap-0">

                            {{-- Color stripe --}}
                            <div
                                class="w-1 bg-primary flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity rounded-l-2xl"></div>

                            {{-- Thumbnail placeholder --}}
                            <div class="w-36 md:w-48 flex-shrink-0 relative overflow-hidden"
                                 style="background: linear-gradient(135deg, #eef3ff 0%, #dce8ff 100%);">
                                <span
                                    class="absolute inset-0 flex items-center justify-center text-5xl">
                                     @if($s->image)
                                        <img src="{{ asset('storage/' . $s->image) }}"
                                             alt="{{ $s->title }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.parentElement.style.background='linear-gradient(135deg,#fef9ed,#fdedc5)'">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-5xl"
                                             style="background: linear-gradient(135deg,#eef3ff,#dce8ff);">
                                    {{ $s->category?->icon ?? '📰' }}
                                </div>
                                    @endif
                                </span>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 p-5 flex flex-col gap-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <div class="badge badge-soft badge-primary text-xs font-bold">
                                        @if($s->category)
                                            <span class="badge badge-soft badge-primary text-xs font-bold">
                                                {{ $s->category->name }}
                                            </span>
                                        @endif
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
                                        <div
                                            class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">
                                            АК
                                        </div>
                                    </div>

                                    <span
                                        class="text-xs font-semibold text-neutral">{{ $s->author->aboutUser->name }} {{ $s->author->aboutUser->surname  }} </span>
                                    <div class="flex items-center gap-3 ml-auto text-xs text-base-content/40">
                                        <span>❤️ {{ $s->likes()->count() }}</span>
                                        <span>💬 {{ $s->comments_count }}</span>
                                        <span>👁 {{ $s->views_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center">Еще никто не добавил никакой статьи</div>
                @endforelse
            </div>
            <div class="mt-10">
                {{ $articles->links() }}
            </div>

        </div>
    </section>


    {{-- ══════════════════════════════ --}}
    {{--  FOOTER                        --}}
    {{-- ══════════════════════════════ --}}
    <footer class="py-6 px-10 bg-neutral">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3">
            <span class="font-display text-xl text-white/60">🐾 PawTalk</span>
            <p class="text-white/30 text-xs">© 2025 PetSpace. Все права защищены.</p>
            <div class="flex gap-4 text-xs text-white/30">
                <a href="#" class="hover:text-white/60 transition-colors">Политика конф.</a>
                <a href="#" class="hover:text-white/60 transition-colors">Условия</a>
                <a href="#" class="hover:text-white/60 transition-colors">Контакты</a>
            </div>
        </div>
    </footer>
    <script>
        async function toggleLike(btn, type, id) {
            // Если не авторизован — редиректим
            @guest
                window.location = '{{ route("login.store") }}'
            return
            @endguest

                try {
                const res = await fetch('{{ route("likes.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({type, id})
                })

                const data = await res.json()

                // Обновляем счётчик
                btn.querySelector('.like-count').textContent = data.count

                // Меняем стиль кнопки
                if (data.liked) {
                    btn.classList.add('text-error')
                    btn.classList.remove('text-base-content/35')
                } else {
                    btn.classList.remove('text-error')
                    btn.classList.add('text-base-content/35')
                }

            } catch (e) {
                console.error('Ошибка лайка:', e)
            }
        }
    </script>
@endsection
