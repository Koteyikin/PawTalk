@extends('layouts.main')
@section('title', 'Просмотр статьи')
@section('body')
    <style>
        :root {
            --color-base-100: oklch(96% 0.003 264.542);
            --color-base-200: oklch(100% 0 0);
            --color-base-300: oklch(86% 0.022 252.894);
            --color-base-content: oklch(27.807% 0.029 256.847);
            --color-primary: #4976F0;
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

        /* Article body typography */
        .article-body h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--custom);
            margin: 2rem 0 0.75rem;
            line-height: 1.3;
        }
        .article-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #374151;
            margin: 1.5rem 0 0.6rem;
        }
        .article-body p {
            font-size: 0.975rem;
            line-height: 1.85;
            color: #4b5563;
            margin-bottom: 1.1rem;
        }
        .article-body ul, .article-body ol {
            padding-left: 1.5rem;
            margin-bottom: 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }
        .article-body li {
            font-size: 0.95rem;
            line-height: 1.7;
            color: #4b5563;
        }
        .article-body ul li::marker { color: #4976F0; }
        .article-body ol li::marker { color: #4976F0; font-weight: 700; }
        .article-body strong { color: #1f2937; font-weight: 600; }
        .article-body blockquote {
            border-left: 3px solid #4976F0;
            background: #eef3ff;
            border-radius: 0 0.75rem 0.75rem 0;
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #374151;
        }
        .article-body .tip-box {
            background: linear-gradient(135deg, #eef3ff 0%, #f0f8ff 100%);
            border: 1px solid rgba(73,118,240,0.2);
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
            margin: 1.5rem 0;
        }
        .article-body .tip-box .tip-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #4976F0;
            margin-bottom: 0.4rem;
        }
        .article-body .warning-box {
            background: linear-gradient(135deg, #fff7ed 0%, #fef3c7 100%);
            border: 1px solid rgba(245,158,11,0.3);
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
            margin: 1.5rem 0;
        }
        .article-body .warning-box .tip-label { color: #D97706; }

        /* Reading progress bar */
        #progress-bar {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            background: #4976F0;
            z-index: 9999;
            transition: width 0.1s linear;
            width: 0%;
        }

        /* Sticky sidebar TOC */
        .toc-link {
            display: block;
            padding: 0.35rem 0.75rem;
            border-left: 2px solid transparent;
            font-size: 0.8rem;
            color: #6b7280;
            transition: all 0.2s;
            border-radius: 0 0.5rem 0.5rem 0;
        }
        .toc-link:hover, .toc-link.active {
            border-left-color: #4976F0;
            color: #4976F0;
            background: rgba(73,118,240,0.07);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-in { animation: fadeIn 0.6s ease both; }
    </style>
    {{-- Reading progress bar --}}
    <div id="progress-bar"></div>
    {{-- ══════════════════════════════ --}}
    {{--  ARTICLE HERO                  --}}
    {{-- ══════════════════════════════ --}}
    <div class="relative overflow-visible" style="background-color: var(--custom); min-height: 420px;">
        {{-- BG --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background: radial-gradient(ellipse 60% 80% at 15% 60%, rgba(73,118,240,0.22) 0%, transparent 70%),
                            radial-gradient(ellipse 50% 60% at 85% 20%, rgba(78,142,162,0.18) 0%, transparent 70%);">
        </div>
        <span class="absolute text-[10rem] opacity-[0.035] right-10 top-0 rotate-6 pointer-events-none">🐱</span>

        <div class="max-w-3xl mx-auto px-6 pt-20 pb-16 relative z-10 animate-in">

            {{-- Breadcrumbs --}}
            <div class="breadcrumbs text-xs text-white/40 mb-6">
                <ul>
                    <li><a href="{{ route('home.index') }}" class="hover:text-white/70">Главная</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white/70">Статьи</a></li>
                    <li class="text-white/60">{{ $articles->category->name ?? 'Статья' }}</li>
                </ul>
            </div>

            {{-- Теги + время чтения --}}
            <div class="flex items-center gap-2 mb-4 flex-wrap">
                @foreach($articles->tags as $tag)
                    <span class="badge badge-primary text-white border-none font-bold text-xs">
                {{ $tag->name }}
            </span>
                @endforeach
                <span class="badge bg-white/15 text-white border-none text-xs">
            {{ $articles->category->name ?? '—' }}
        </span>
                <span class="text-white/40 text-xs ml-1">
            {{ $articles->reading_time }} мин чтения
        </span>
            </div>

            {{-- Заголовок --}}
            <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight mb-8">
                {{ $articles->title }}
            </h1>

            {{-- Автор + метрики --}}
            <div class="flex items-center justify-between gap-4 flex-wrap">

                {{-- Автор --}}
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="w-11 h-11 rounded-full bg-primary text-white font-bold
                            flex items-center justify-center text-sm flex-shrink-0">
                            {{ mb_strtoupper(mb_substr($articles->author->aboutUser->name ?? 'А', 0, 1)) }}
                        </div>
                    </div>
                    <div>
                        <div class="text-white font-semibold text-sm">
                            {{ $articles->author->aboutUser->name ?? '—' }}
                            {{ $articles->author->aboutUser->surname ?? '' }}
                        </div>
                        <div class="text-white/40 text-xs">
                            {{ $articles->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- Метрики --}}
                <div class="flex items-center gap-4 text-white/50 text-sm">
            <span class="flex items-center gap-1">
                ❤️ <span>{{ $articles->likes()->count() }}</span>
            </span>
                    <span class="flex items-center gap-1">
                💬 <span>{{ $articles->comments_count }}</span>
            </span>
                    <span class="flex items-center gap-1">
                👁 <span>{{ $articles->views_count }}</span>
            </span>
                </div>

            </div>
        </div>
    </div>


    {{-- ══════════════════════════════ --}}
    {{--  ARTICLE CONTENT + SIDEBAR     --}}
    {{-- ══════════════════════════════ --}}
    <section class="py-12 px-6 bg-base-100">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-10 items-start">

                {{-- ── MAIN ARTICLE ── --}}
                <article class="animate-in">

                    {{-- Lead paragraph --}}
                    <p class="text-base leading-relaxed text-base-content/80 font-light mb-8 text-lg
                           border-l-4 border-primary pl-5 py-1"
                       style="font-family: 'Playfair Display', serif; font-style: italic;">
                        {{ $articles->excerpt }}
                    </p>

                    {{-- Article body --}}
                    <div class="article-body" id="article-body">{!! $articles->body !!}

                    </div>{{-- end article-body --}}

                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-2 mt-10 pt-8 border-t border-base-300">
                        <span class="text-xs text-base-content/40 mr-1 self-center">Теги:</span>
                        @foreach($articles->tags as $tag)
                            <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">{{ $tag->name }}</span>
                        @endforeach
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 mt-6 flex-wrap">
                        <button
                            onclick="toggleLike(this, 'article', {{ $articles->id }})"
                            class="btn btn-sm rounded-full gap-2 transition-all {{ $articles->likes()->where('user_id', auth()->id())->exists() ? 'btn-error text-white border-none' : 'btn-outline border-base-300 text-base-content/50' }}"
                            data-liked="{{ $articles->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}">
                            ❤️ <span class="like-count">{{ $articles->likes()->count() }}</span>
                        </button>
                        @auth
{{--                            <button id="bookmark-btn" onclick="toggleBookmark({{ $articles->id }})" class="btn btn-sm rounded-full gap-2 transition-all--}}
{{--                                {{ \App\Models\Bookmarks::where('user_id', auth()->id())->where('article_id', $articles->id)->exists() ? 'btn-warning text-white border-none' : 'btn-outline border-base-300 text-base-content/50' }}">--}}
{{--                                🔖 <span id="bookmark-label">--}}
{{--                                {{ \App\Models\Bookmarks::where('user_id', auth()->id())->where('article_id', $articles->id)->exists() ? 'В избранном' : 'В избранное' }}--}}
{{--                                    </span>--}}
{{--                            </button>--}}
                            <script>
                                async function toggleBookmark(articleId) {
                                    const btn   = document.getElementById('bookmark-btn')
                                    const label = document.getElementById('bookmark-label')

                                    const res = await fetch('{{ route("bookmarks.toggle") }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                        },
                                        body: JSON.stringify({ article_id: articleId })
                                    })

                                    const data = await res.json()

                                    if (data.bookmarked) {
                                        btn.classList.remove('btn-outline', 'border-base-300', 'text-base-content/50')
                                        btn.classList.add('btn-warning', 'text-white', 'border-none')
                                        label.textContent = 'В избранном'
                                    } else {
                                        btn.classList.remove('btn-warning', 'text-white', 'border-none')
                                        btn.classList.add('btn-outline', 'border-base-300', 'text-base-content/50')
                                        label.textContent = 'В избранное'
                                    }
                                }
                            </script>
                        @endauth
                    </div>


                    {{-- ── AUTHOR CARD ── --}}
                    <div class="card bg-base-200 border border-base-300 mt-10">
                        <div class="card-body flex-row items-center gap-5 p-6">
                            <div class="avatar placeholder flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-primary text-white font-bold text-xl flex items-center justify-center">АК</div>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-1">Об авторе</div>
                                <div class="font-display font-bold text-lg text-neutral">{{ $articles->author->aboutUser->name ?? 'Анонимный' }} {{  $articles->author->aboutUser->surname ?? 'автор' }}</div>
                                <p class="text-sm text-base-content/60 leading-relaxed mt-1">
                                    {{  $articles->author->aboutUser->description ?? 'Автор решил остаться анонимным'  }}
                                </p>
                            </div>
                        </div>
                    </div>


                    {{-- ── COMMENTS ── --}}
                    <div class="mt-12">
                        <h3 class="font-display text-2xl font-bold text-neutral mb-6">
                            Комментарии <span class="text-base-content/30 text-lg font-normal">(12)</span>
                        </h3>

                        {{-- Add comment --}}
                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                            <input type="hidden" value="{{ $articles->id }}" name="article_id">
                            <input type="hidden" value="" name="parent_id">
                            <input type="hidden" value="1" name="is_approved">
                            <div class="card bg-base-200 border border-base-300 mb-6">
                                <div class="card-body p-5 gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder flex-shrink-0">
                                            <div class="w-9 h-9 rounded-full bg-neutral/20 text-neutral/40 font-bold flex items-center justify-center text-xs">Вы</div>
                                        </div>
                                        <textarea name="body" class="textarea textarea-bordered bg-base-100 rounded-2xl flex-1 text-sm resize-none
                                                     focus:border-primary focus:outline-none"
                                                  rows="2" placeholder="Напишите комментарий..."></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button class="btn btn-primary btn-sm rounded-full px-6 text-white border-none">
                                            Отправить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @foreach($articles->comments->whereNull('parent_id') as $comment)
                            <div class="flex gap-3 mb-5">
                                <div class="avatar placeholder flex-shrink-0">
                                    <div class="w-9 h-9 rounded-full bg-accent text-white font-bold flex items-center justify-center text-xs">
                                        {{ mb_strtoupper(mb_substr($comment->author->aboutUser->name ?? 'А', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="card bg-base-200 border border-base-300">
                                        <div class="card-body p-4 gap-2">
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-neutral">
                                                    {{ $comment->author->aboutUser->name ?? '—' }}
                                                    {{ $comment->author->aboutUser->surname ?? '' }}
                                                </span>
                                                <span class="text-xs text-base-content/35">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-base-content/70 leading-relaxed">
                                                {{ $comment->body }}
                                            </p>
                                            <div class="flex items-center gap-3 text-xs text-base-content/35 mt-1">
                                                <button
                                                    onclick="toggleLike(this, 'comment', {{ $comment->id }})"
                                                    class="hover:text-error transition-colors flex items-center gap-1"
                                                    data-liked="{{ $comment->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}">
                                                    ❤️ <span class="like-count">{{ $comment->likes()->count() }}</span>
                                                </button>
                                                <button type="button"
                                                        onclick="document.getElementById('reply-{{ $comment->id }}').classList.toggle('hidden')"
                                                        class="hover:text-primary transition-colors">
                                                    💬 Ответить
                                                </button>
                                            </div>
                                            {{-- Форма ответа --}}
                                            <div id="reply-{{ $comment->id }}" class="hidden mt-3">
                                                <form method="POST" action="{{ route('comments.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="article_id" value="{{ $articles->id }}">
                                                    <input type="hidden" name="user_id"    value="{{ auth()->id() }}">
                                                    <input type="hidden" name="parent_id"  value="{{ $comment->id }}">
                                                    <input type="hidden" name="is_approved" value="0">
                                                    <div class="flex flex-col gap-2">
                                                        <textarea name="body" rows="2" placeholder="Ваш ответ..." class="textarea bg-base-100 border border-base-300 rounded-xl text-sm resize-none focus:border-primary focus:outline-none w-full" required></textarea>
                                                        <div class="flex gap-2 justify-end">
                                                            <button type="button" onclick="document.getElementById('reply-{{ $comment->id }}').classList.add('hidden')" class="btn btn-xs btn-ghost rounded-full">
                                                                Отмена
                                                            </button>
                                                            <button type="submit" class="btn btn-xs btn-primary rounded-full text-white border-none">
                                                                Отправить
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Ответы --}}
                                    @foreach($comment->replies as $reply)
                                        <div class="flex gap-3 mt-2 ml-8">
                                            <div class="avatar placeholder flex-shrink-0">
                                                <div class="w-7 h-7 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs">
                                                    {{ mb_strtoupper(mb_substr($reply->author->aboutUser->name ?? 'А', 0, 1)) }}
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="card bg-base-100 border border-base-300">
                                                    <div class="card-body p-3 gap-1">
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-xs font-semibold text-neutral">
                                                                {{ $reply->author->aboutUser->name ?? '—' }}
                                                                {{ $reply->author->aboutUser->surname ?? '' }}
                                                            </span>
                                                            <span class="text-xs text-base-content/35">
                                                                {{ $reply->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                        <p class="text-sm text-base-content/70">{{ $reply->body }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    </div>
                </article>

                {{-- ── SIDEBAR ── --}}
                <aside class="flex flex-col gap-5 lg:sticky lg:top-24 animate-in">

                    @php
                        // Парсим заголовки из body статьи
                        preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/i', $articles->body, $matches);
                        $headings = $matches[1] ?? [];
                    @endphp

                    @if(count($headings) > 0)
                        <div class="card bg-base-200 border border-base-300">
                            <div class="card-body p-5 gap-3">
                                <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">
                                    Содержание
                                </h5>
                                <nav class="flex flex-col gap-0.5">
                                    @foreach($headings as $index => $heading)
                                        <a href="#heading-{{ $index }}"
                                           class="toc-link block py-1.5 px-3 text-sm text-base-content/60 border-l-2 border-transparent rounded-r-lg hover:border-primary hover:text-primary hover:bg-primary/5 transition-all duration-200">
                                            {{ strip_tags($heading) }}
                                        </a>
                                    @endforeach
                                </nav>
                            </div>
                        </div>
                    @endif

                    {{-- Share --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-5 gap-3">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Поделиться</h5>
                            <div class="flex gap-2">

                                {{-- VK --}}
                                <a href="https://vk.com/share.php?url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($articles->title) }}"
                                   target="_blank"
                                   class="btn btn-sm flex-1 rounded-full bg-blue-500 text-white border-none hover:bg-blue-600 text-xs">
                                    VK
                                </a>
                                {{-- Telegram --}}
                                <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($articles->title) }}"
                                   target="_blank"
                                   class="btn btn-sm flex-1 rounded-full bg-sky-400 text-white border-none hover:bg-sky-500 text-xs">
                                    TG
                                </a>

                            </div>
                        </div>
                    </div>

                    <script>
                        function copyLink(btn) {
                            navigator.clipboard.writeText(window.location.href).then(() => {
                                const original = btn.innerHTML
                                btn.innerHTML = '✅'
                                btn.classList.add('bg-success', 'text-white')
                                setTimeout(() => {
                                    btn.innerHTML = original
                                    btn.classList.remove('bg-success', 'text-white')
                                }, 2000)
                            })
                        }
                    </script>
                </aside>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════ --}}
    {{--  MORE ARTICLES ROW             --}}
    {{-- ══════════════════════════════ --}}
    <section class="py-12 px-6 bg-base-200 border-t border-base-300">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-display text-2xl font-bold text-neutral">Читайте также</h3>
                <a href="{{ route('articles.index') }}"
                   class="btn btn-sm btn-outline btn-primary rounded-full">Все статьи →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach(\App\Models\Article::latest()->take(3)->get() as $s)
                    <a href="{{ route('articles.show', $s->id) }}"
                       class="card bg-base-100 border border-base-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-250 group">
                        <div class="h-32 rounded-t-2xl flex items-center justify-center text-5xl"
                             style="background: linear-gradient(135deg,#fef9ed,#fdedc5);">
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
                        </div>
                        <div class="card-body p-5 gap-2">
                            <div class="badge badge-soft badge-warning text-xs w-fit">🦜 {{ $s->category->name }}</div>
                            <h4 class="font-display font-bold text-base text-neutral group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                {{ $s->title }}
                            </h4>
                            <p class="text-xs text-base-content/40">{{ $s->reding_time }} · {{$s->likes()->count()}} ❤️</p>
                        </div>
                    </a>
                @endforeach

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
    {{-- Progress bar script --}}
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
                    body: JSON.stringify({ type, id })
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
        window.addEventListener('scroll', () => {
            const doc = document.documentElement;
            const scrollTop = doc.scrollTop || document.body.scrollTop;
            const scrollHeight = doc.scrollHeight - doc.clientHeight;
            const progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
            document.getElementById('progress-bar').style.width = progress + '%';
        });

        // TOC active link highlight
        const tocLinks = document.querySelectorAll('.toc-link');
        const sections = ['why-stress','preparation','transport','clinic','after']
            .map(id => document.getElementById(id))
            .filter(Boolean);

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                if (window.scrollY >= section.offsetTop - 160) current = section.id;
            });
            tocLinks.forEach(link => {
                link.classList.toggle('active', link.getAttribute('href') === '#' + current);
            });
        });
        // Добавляем id к заголовкам в теле статьи
        document.addEventListener('DOMContentLoaded', () => {
            const articleBody = document.querySelector('#article-body')
            if (!articleBody) return

            const headings = articleBody.querySelectorAll('h2, h3')
            headings.forEach((heading, index) => {
                heading.id = 'heading-' + index
                heading.classList.add('scroll-mt-24') // отступ при скролле из-за sticky navbar
            })

            // Подсветка активного пункта при скролле
            const tocLinks = document.querySelectorAll('.toc-link')

            window.addEventListener('scroll', () => {
                let current = 0
                headings.forEach((heading, index) => {
                    if (window.scrollY >= heading.offsetTop - 140) {
                        current = index
                    }
                })
                tocLinks.forEach((link, index) => {
                    link.classList.toggle('border-primary', index === current)
                    link.classList.toggle('text-primary', index === current)
                    link.classList.toggle('bg-primary/5', index === current)
                    link.classList.toggle('border-transparent', index !== current)
                })
            })
        })
        function copyLink(btn) {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const original = btn.innerHTML
                btn.innerHTML = '✅'
                btn.classList.add('bg-success', 'text-white')
                setTimeout(() => {
                    btn.innerHTML = original
                    btn.classList.remove('bg-success', 'text-white')
                }, 2000)
            })
        }
    </script>

@endsection
