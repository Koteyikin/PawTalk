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
    </head>
    <body class="bg-base-100 text-base-content">

    {{-- Reading progress bar --}}
    <div id="progress-bar"></div>
    {{-- ══════════════════════════════ --}}
    {{--  ARTICLE HERO                  --}}
    {{-- ══════════════════════════════ --}}
    <div class="relative overflow-hidden" style="background-color: var(--custom); min-height: 420px;">
        {{-- BG --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background: radial-gradient(ellipse 60% 80% at 15% 60%, rgba(73,118,240,0.22) 0%, transparent 70%),
                            radial-gradient(ellipse 50% 60% at 85% 20%, rgba(78,142,162,0.18) 0%, transparent 70%);">
        </div>
        <span class="absolute text-[10rem] opacity-[0.035] right-10 top-0 rotate-6 pointer-events-none">🐱</span>

        <div class="max-w-3xl mx-auto px-6 py-16 relative z-10 animate-in">

            {{-- Breadcrumbs --}}
            <div class="breadcrumbs text-xs text-white/40 mb-6">
                <ul>
                    <li><a href="{{ route('home.index') }}" class="hover:text-white/70">Главная</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white/70">Статьи</a></li>
                    <li class="text-white/60">Здоровье</li>
                </ul>
            </div>

            {{-- Category & reading time --}}
            <div class="flex items-center gap-3 mb-5 flex-wrap">
                <div class="badge badge-primary text-white border-none font-bold">Здоровье</div>
                <div class="badge bg-white/15 text-white border-none">🐱 Кошки</div>
                <span class="text-white/40 text-xs">5 мин чтения</span>
            </div>

            {{-- Title --}}
            <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight mb-6">
                Как подготовить кошку<br class="hidden md:block"> к первому визиту<br class="hidden md:block"> к ветеринару
            </h1>

            {{-- Author + meta --}}
            <div class="flex items-center gap-4 flex-wrap">
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="w-11 h-11 rounded-full bg-primary text-white font-bold flex items-center justify-center text-sm">АК</div>
                    </div>
                    <div>
                        <div class="text-white font-semibold text-sm">Анна Козлова</div>
                        <div class="text-white/40 text-xs">14 апреля 2025</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 ml-auto text-white/50 text-sm">
                    <span>❤️ 48</span>
                    <span>💬 12</span>
                    <span>👁 320</span>
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
                        Первый поход к ветеринару — это стресс не только для питомца, но и для хозяина.
                        Расскажем, как подготовиться, чтобы визит прошёл максимально спокойно для обеих сторон.
                    </p>

                    {{-- Article body --}}
                    <div class="article-body" id="article-content">

                        <h2 id="why-stress">Почему кошки боятся ветеринара</h2>
                        <p>
                            Для кошки поездка к врачу — это целый набор стрессоров: незнакомый запах переноски,
                            шум машины, чужое помещение, запахи других животных и чужие руки. В отличие от собак,
                            кошки — территориальные животные, которые крайне болезненно реагируют на любое
                            нарушение привычного пространства.
                        </p>
                        <p>
                            <strong>Важно понимать:</strong> стресс во время визита — это не просто дискомфорт.
                            Он влияет на физиологические показатели: пульс, давление, температуру тела.
                            Это может затруднить диагностику и даже исказить результаты анализов.
                        </p>

                        <div class="tip-box">
                            <div class="tip-label">💡 Совет эксперта</div>
                            <p style="margin:0; color:#374151; font-size:0.9rem;">
                                Исследования показывают, что кошки, которых приучали к переноске с детства,
                                переносят визиты к ветеринару в 3-4 раза спокойнее. Начинайте приучение
                                как можно раньше.
                            </p>
                        </div>

                        <h2 id="preparation">Подготовка за несколько дней</h2>
                        <h3>Приучите кошку к переноске заранее</h3>
                        <p>
                            Главная ошибка — доставать переноску только перед визитом к врачу. Кошка мгновенно
                            ассоциирует её с неприятным опытом. Поставьте переноску в жилой зоне за 5-7 дней
                            до визита и положите внутрь любимое одеяло или игрушку.
                        </p>
                        <ul>
                            <li>Оставьте дверцу открытой — пусть кошка заходит добровольно</li>
                            <li>Покормите питомца рядом с переноской, а потом и внутри неё</li>
                            <li>Использруйте феромоновый спрей Feliway — он снижает тревожность</li>
                            <li>Накройте переноску знакомым полотенцем с вашим запахом</li>
                        </ul>

                        <h3>Не кормите за 3-4 часа до визита</h3>
                        <p>
                            Голодный желудок снизит риск рвоты во время транспортировки. Кроме того,
                            некоторые процедуры и анализы требуют пустого желудка. Воду при этом убирать
                            не нужно — она должна быть доступна вплоть до выезда.
                        </p>

                        <h2 id="transport">Транспортировка</h2>
                        <p>
                            Накройте переноску полотенцем: это создаёт ощущение укрытия и снижает
                            визуальную стимуляцию. Избегайте резких торможений и громкой музыки в машине.
                            Говорите с кошкой спокойным голосом на протяжении всей дороги.
                        </p>

                        <blockquote>
                            «Голос хозяина — один из самых мощных успокаивающих факторов для кошки
                            во время стресса. Не молчите в машине.»
                            <br>— Доктор Светлана Морозова, ветеринар-фелинолог
                        </blockquote>

                        <h2 id="clinic">В клинике</h2>
                        <p>
                            По возможности запишитесь на первый приём с утра: меньше очередей, меньше
                            чужих животных в зале ожидания, врач ещё не устал. Попросите администратора
                            провести вас сразу в кабинет, минуя общий зал.
                        </p>

                        <div class="warning-box">
                            <div class="tip-label">⚠️ Обратите внимание</div>
                            <p style="margin:0; color:#92400e; font-size:0.9rem;">
                                Не выпускайте кошку из переноски в зоне ожидания даже если она просится —
                                там могут быть другие животные, запахи которых усилят тревожность.
                            </p>
                        </div>

                        <h3>Что взять с собой</h3>
                        <ol>
                            <li>Ветеринарный паспорт с отметками о прививках</li>
                            <li>Список текущих лекарств (если питомец что-то принимает)</li>
                            <li>Анализы, если были сданы заранее</li>
                            <li>Любимое лакомство для поощрения после осмотра</li>
                            <li>Сменную пелёнку на случай «аварии»</li>
                        </ol>

                        <h2 id="after">После визита</h2>
                        <p>
                            Дома создайте кошке тихое спокойное место, где она сможет прийти в себя.
                            Не навязывайте контакт: позвольте ей самой решить, когда она готова к общению.
                            Угостите лакомством и поиграйте в привычные игры — это поможет восстановить
                            ощущение безопасности.
                        </p>
                        <p>
                            Если визиты к ветеринару предстоят регулярно (хронические заболевания, плановые
                            осмотры), стоит проконсультироваться с врачом о применении лёгких успокоительных
                            средств на растительной основе.
                        </p>

                    </div>{{-- end article-body --}}


                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-2 mt-10 pt-8 border-t border-base-300">
                        <span class="text-xs text-base-content/40 mr-1 self-center">Теги:</span>
                        <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">🐱 Кошки</span>
                        <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">Здоровье</span>
                        <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">Ветеринар</span>
                        <span class="badge badge-ghost hover:badge-primary cursor-pointer transition-colors">Советы</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 mt-6 flex-wrap">
                        <button class="btn btn-sm btn-outline btn-error rounded-full gap-2 hover:scale-105 transition-transform">
                            ❤️ Нравится <span class="font-bold">48</span>
                        </button>
                        <button class="btn btn-sm btn-outline rounded-full gap-2">
                            🔗 Поделиться
                        </button>
                        <button class="btn btn-sm btn-ghost rounded-full gap-2 text-base-content/40">
                            🚩 Пожаловаться
                        </button>
                    </div>


                    {{-- ── AUTHOR CARD ── --}}
                    <div class="card bg-base-200 border border-base-300 mt-10">
                        <div class="card-body flex-row items-center gap-5 p-6">
                            <div class="avatar placeholder flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-primary text-white font-bold text-xl flex items-center justify-center">АК</div>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-1">Об авторе</div>
                                <div class="font-display font-bold text-lg text-neutral">Анна Козлова</div>
                                <p class="text-sm text-base-content/60 leading-relaxed mt-1">
                                    Ветеринарный фелинолог с 8-летним стажем. Хозяйка трёх кошек.
                                    Пишет о здоровье и поведении кошек простым языком.
                                </p>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline btn-primary rounded-full flex-shrink-0">
                                Все статьи
                            </a>
                        </div>
                    </div>


                    {{-- ── COMMENTS ── --}}
                    <div class="mt-12">
                        <h3 class="font-display text-2xl font-bold text-neutral mb-6">
                            Комментарии <span class="text-base-content/30 text-lg font-normal">(12)</span>
                        </h3>

                        {{-- Add comment --}}
                        <div class="card bg-base-200 border border-base-300 mb-6">
                            <div class="card-body p-5 gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="avatar placeholder flex-shrink-0">
                                        <div class="w-9 h-9 rounded-full bg-neutral/20 text-neutral/40 font-bold flex items-center justify-center text-xs">Вы</div>
                                    </div>
                                    <textarea class="textarea textarea-bordered bg-base-100 rounded-2xl flex-1 text-sm resize-none
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

                        {{-- Comment 1 --}}
                        <div class="flex gap-3 mb-5">
                            <div class="avatar placeholder flex-shrink-0">
                                <div class="w-9 h-9 rounded-full bg-accent text-white font-bold flex items-center justify-center text-xs">МС</div>
                            </div>
                            <div class="flex-1">
                                <div class="card bg-base-200 border border-base-300">
                                    <div class="card-body p-4 gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-neutral">Михаил Семёнов</span>
                                            <span class="text-xs text-base-content/35">2 часа назад</span>
                                        </div>
                                        <p class="text-sm text-base-content/70 leading-relaxed">
                                            Отличная статья! Про феромоновый спрей — золото. Моя Муся теперь
                                            сама заходит в переноску после того, как мы начали его использовать.
                                        </p>
                                        <div class="flex items-center gap-3 text-xs text-base-content/35 mt-1">
                                            <button class="hover:text-primary transition-colors">❤️ 7</button>
                                            <button class="hover:text-primary transition-colors">Ответить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Comment 2 --}}
                        <div class="flex gap-3 mb-5">
                            <div class="avatar placeholder flex-shrink-0">
                                <div class="w-9 h-9 rounded-full bg-success text-white font-bold flex items-center justify-center text-xs">ЕВ</div>
                            </div>
                            <div class="flex-1">
                                <div class="card bg-base-200 border border-base-300">
                                    <div class="card-body p-4 gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-neutral">Елена Васильева</span>
                                            <span class="text-xs text-base-content/35">5 часов назад</span>
                                        </div>
                                        <p class="text-sm text-base-content/70 leading-relaxed">
                                            Добавлю от себя: попросите клинику о кошачьем кабинете — многие
                                            современные клиники принимают кошек отдельно от собак. Это
                                            существенно снижает стресс.
                                        </p>
                                        <div class="flex items-center gap-3 text-xs text-base-content/35 mt-1">
                                            <button class="hover:text-primary transition-colors">❤️ 14</button>
                                            <button class="hover:text-primary transition-colors">Ответить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-ghost btn-sm rounded-full border border-base-300 text-base-content/50 hover:border-primary hover:text-primary mt-2 transition-all">
                            Показать ещё 10 комментариев
                        </button>
                    </div>

                </article>


                {{-- ── SIDEBAR ── --}}
                <aside class="flex flex-col gap-5 lg:sticky lg:top-24 animate-in">

                    {{-- Table of contents --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-5 gap-3">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Содержание</h5>
                            <nav class="flex flex-col gap-0.5">
                                <a href="#why-stress"   class="toc-link active">Почему кошки боятся врача</a>
                                <a href="#preparation"  class="toc-link">Подготовка заранее</a>
                                <a href="#transport"    class="toc-link">Транспортировка</a>
                                <a href="#clinic"       class="toc-link">В клинике</a>
                                <a href="#after"        class="toc-link">После визита</a>
                            </nav>
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-5 gap-3">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Поделиться</h5>
                            <div class="flex gap-2">
                                <button class="btn btn-sm flex-1 rounded-full bg-blue-500 text-white border-none hover:bg-blue-600 text-xs">VK</button>
                                <button class="btn btn-sm flex-1 rounded-full bg-sky-400 text-white border-none hover:bg-sky-500 text-xs">TG</button>
                                <button class="btn btn-sm flex-1 rounded-full bg-base-300 text-base-content border-none hover:bg-base-300 text-xs">🔗</button>
                            </div>
                        </div>
                    </div>

                    {{-- Related articles --}}
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-5 gap-4">
                            <h5 class="text-xs font-bold uppercase tracking-[0.1em] text-base-content/40">Похожие статьи</h5>

                            <a href="{{ route('articles.show', 6) }}"
                               class="flex gap-3 group items-start">
                                <div class="w-14 h-14 rounded-xl flex-shrink-0 flex items-center justify-center text-2xl"
                                     style="background: linear-gradient(135deg,#eef3ff,#dce8ff);">🐈</div>
                                <div>
                                    <p class="text-xs font-semibold text-neutral leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                        Почему кошка мурлычет и что это на самом деле значит
                                    </p>
                                    <p class="text-xs text-base-content/40 mt-1">4 мин · 128 ❤️</p>
                                </div>
                            </a>

                            <div class="divider my-0"></div>

                            <a href="{{ route('articles.show', 3) }}"
                               class="flex gap-3 group items-start">
                                <div class="w-14 h-14 rounded-xl flex-shrink-0 flex items-center justify-center text-2xl"
                                     style="background: linear-gradient(135deg,#e6faf3,#c5f0e1);">🐰</div>
                                <div>
                                    <p class="text-xs font-semibold text-neutral leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                        5 признаков того, что вашему кролику нужна срочная помощь
                                    </p>
                                    <p class="text-xs text-base-content/40 mt-1">7 мин · 61 ❤️</p>
                                </div>
                            </a>

                            <div class="divider my-0"></div>

                            <a href="{{ route('articles.show', 2) }}"
                               class="flex gap-3 group items-start">
                                <div class="w-14 h-14 rounded-xl flex-shrink-0 flex items-center justify-center text-2xl"
                                     style="background: linear-gradient(135deg,#e8f5f8,#c8e8ef);">🐶</div>
                                <div>
                                    <p class="text-xs font-semibold text-neutral leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                        Сырое питание для собак: мифы и реальность
                                    </p>
                                    <p class="text-xs text-base-content/40 mt-1">12 мин · 93 ❤️</p>
                                </div>
                            </a>
                        </div>
                    </div>

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

                <a href="{{ route('articles.show', 4) }}"
                   class="card bg-base-100 border border-base-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-250 group">
                    <div class="h-32 rounded-t-2xl flex items-center justify-center text-5xl"
                         style="background: linear-gradient(135deg,#fef9ed,#fdedc5);">🦜</div>
                    <div class="card-body p-5 gap-2">
                        <div class="badge badge-soft badge-warning text-xs w-fit">🦜 Птицы</div>
                        <h4 class="font-display font-bold text-base text-neutral group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            Как научить попугая говорить: проверенные методики
                        </h4>
                        <p class="text-xs text-base-content/40">9 мин · 74 ❤️</p>
                    </div>
                </a>

                <a href="{{ route('articles.show', 5) }}"
                   class="card bg-base-100 border border-base-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-250 group">
                    <div class="h-32 rounded-t-2xl flex items-center justify-center text-5xl"
                         style="background: linear-gradient(135deg,#fef2f2,#fecaca);">🐠</div>
                    <div class="card-body p-5 gap-2">
                        <div class="badge badge-soft badge-error text-xs w-fit">🐠 Рыбки</div>
                        <h4 class="font-display font-bold text-base text-neutral group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            Аквариум для начинающих: 10 ошибок, которые убивают рыбок
                        </h4>
                        <p class="text-xs text-base-content/40">6 мин · 55 ❤️</p>
                    </div>
                </a>

                <a href="{{ route('articles.show', 2) }}"
                   class="card bg-base-100 border border-base-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-250 group">
                    <div class="h-32 rounded-t-2xl flex items-center justify-center text-5xl"
                         style="background: linear-gradient(135deg,#e8f5f8,#c8e8ef);">🐶</div>
                    <div class="card-body p-5 gap-2">
                        <div class="badge badge-soft badge-accent text-xs w-fit">Питание</div>
                        <h4 class="font-display font-bold text-base text-neutral group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            Сырое питание для собак: мифы и реальность в 2025 году
                        </h4>
                        <p class="text-xs text-base-content/40">12 мин · 93 ❤️</p>
                    </div>
                </a>

            </div>
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


    {{-- Progress bar script --}}
    <script>
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
    </script>

@endsection
