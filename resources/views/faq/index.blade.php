@extends('layouts.main')
@section('title', 'FAQ — Частые вопросы')
@section('body')

    {{-- ── HERO ── --}}
    <div class="relative overflow-hidden py-16 px-6" style="background-color: var(--custom, #545871);">
        <div class="absolute inset-0 pointer-events-none"
             style="background: radial-gradient(ellipse 50% 80% at 10% 50%, rgba(73,118,240,0.2) 0%, transparent 70%),
                            radial-gradient(ellipse 40% 60% at 90% 30%, rgba(78,142,162,0.18) 0%, transparent 70%);">
        </div>
        <span class="absolute text-9xl opacity-[0.04] right-10 top-0 rotate-12 pointer-events-none">❓</span>

        <div class="max-w-3xl mx-auto relative z-10">
            <div class="breadcrumbs text-xs text-white/40 mb-6">
                <ul>
                    <li><a href="{{ route('home.index') }}" class="hover:text-white/70">Главная</a></li>
                    <li class="text-white/60">FAQ</li>
                </ul>
            </div>

            <p class="text-info text-xs font-bold uppercase tracking-[0.14em] mb-3">Помощь и поддержка</p>
            <h1 class="font-display text-4xl md:text-5xl font-black text-white leading-tight mb-3">
                Частые вопросы
            </h1>
            <p class="text-white/55 text-sm leading-relaxed max-w-lg mb-8">
                Здесь собраны ответы на самые популярные вопросы о платформе и уходе за питомцами.
                Не нашли ответ? Задайте свой вопрос!
            </p>

            <button onclick="faq_modal.showModal()"
                    class="btn btn-primary rounded-full px-7 text-white border-none shadow-xl hover:-translate-y-1 transition-transform">
                ✉️ Задать вопрос
            </button>
        </div>
    </div>

    {{-- ── FAQ СПИСОК ── --}}
    <section class="py-16 px-6 bg-base-100">
        <div class="max-w-3xl mx-auto">

            @if(session('success'))
                <div class="alert alert-success rounded-2xl mb-8 shadow-sm">
                    <span>✅ {{ session('success') }}</span>
                </div>
            @endif

            @forelse($faqs as $category => $items)
                {{-- Заголовок категории --}}
                <div class="flex items-center gap-3 mb-5 mt-8 first:mt-0">
                <span class="text-xs font-bold uppercase tracking-[0.14em] text-primary">
                    {{ $category ?? 'Общие вопросы' }}
                </span>
                    <div class="flex-1 h-px bg-base-300"></div>
                </div>

                {{-- Аккордеон вопросов --}}
                <div class="flex flex-col gap-3">
                    @foreach($items as $faq)
                        <div class="collapse collapse-arrow bg-base-200 border border-base-300 rounded-2xl
                                hover:border-primary/30 transition-all">
                            <input type="radio" name="faq-{{ $category }}" />
                            <div class="collapse-title font-semibold text-neutral text-sm pe-10">
                                {{ $faq->question }}
                            </div>
                            <div class="collapse-content">
                                <p class="text-sm text-base-content/70 leading-relaxed pt-1">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center py-16 text-base-content/40">
                    <div class="text-5xl mb-4">❓</div>
                    <p>Вопросы ещё не добавлены</p>
                </div>
            @endforelse

            {{-- CTA снизу --}}
            <div class="mt-16 card border border-primary/20 rounded-3xl overflow-hidden">
                <div class="card-body items-center text-center p-10 gap-4"
                     style="background: linear-gradient(135deg, #eef3ff 0%, #f0f8ff 100%);">
                    <span class="text-4xl">🤔</span>
                    <h3 class="font-display text-xl font-bold text-neutral">Не нашли ответ?</h3>
                    <p class="text-sm text-base-content/60 max-w-sm">
                        Задайте свой вопрос и наши эксперты ответят в ближайшее время
                    </p>
                    <button onclick="faq_modal.showModal()"
                            class="btn btn-primary rounded-full px-8 text-white border-none mt-2">
                        ✉️ Задать вопрос
                    </button>
                </div>
            </div>

        </div>
    </section>

    {{-- ── МОДАЛКА ── --}}
    <dialog id="faq_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-backdrop bg-neutral/40 backdrop-blur-sm" onclick="faq_modal.close()"></div>

        <div class="modal-box bg-base-200 border border-base-300 rounded-3xl shadow-2xl p-0 w-full max-w-lg overflow-hidden">

            {{-- Header --}}
            <div class="relative px-8 pt-7 pb-6 border-b border-base-300 overflow-hidden"
                 style="background: linear-gradient(135deg, var(--custom, #545871) 0%, #3a3d52 100%);">
                <span class="absolute -right-2 -bottom-4 text-8xl opacity-[0.07] select-none pointer-events-none leading-none">❓</span>

                <button onclick="faq_modal.close()"
                        class="absolute top-4 right-4 btn btn-sm btn-ghost text-white/40
                           hover:text-white hover:bg-white/10 rounded-full w-8 h-8 p-0 min-h-0 z-10">
                    ✕
                </button>

                <div class="pr-8">
                <span class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-white/60 mb-3">
                    ✉️ Задать вопрос
                </span>
                    <h2 class="font-display text-xl font-bold text-white leading-tight">
                        Мы вам ответим
                    </h2>
                    <p class="text-white/50 text-sm mt-1">
                        Обычно отвечаем в течение 24 часов
                    </p>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('faq.store') }}" class="px-8 py-6 flex flex-col gap-4">
                @csrf

                @guest
                    {{-- Имя и email только для гостей --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="form-control gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                                Ваше имя
                            </label>
                            <input type="text" name="name"
                                   placeholder="Александр"
                                   class="input bg-base-100 border border-base-300 rounded-2xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-primary transition-all w-full" />
                        </div>
                        <div class="form-control gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                                Email для ответа
                            </label>
                            <input type="email" name="email"
                                   placeholder="email@mail.ru"
                                   class="input bg-base-100 border border-base-300 rounded-2xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-primary transition-all w-full" />
                        </div>
                    </div>
                @endguest

                @auth
                    <div class="flex items-center gap-3 p-3 bg-primary/5 border border-primary/20 rounded-2xl">
                        <div class="w-8 h-8 rounded-full bg-primary text-white text-xs font-bold
                                flex items-center justify-center flex-shrink-0">
                            {{ mb_strtoupper(mb_substr(auth()->user()->nickname ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-neutral">
                                {{ auth()->user()->aboutUser->name ?? auth()->user()->nickname }}
                            </div>
                            <div class="text-xs text-base-content/40">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                @endauth

                <div class="form-control gap-1.5">
                    <label class="text-xs font-bold uppercase tracking-widest text-base-content/50">
                        Ваш вопрос <span class="text-error">*</span>
                    </label>
                    <textarea name="question" rows="4" required
                              placeholder="Опишите ваш вопрос как можно подробнее..."
                              class="textarea bg-base-100 border border-base-300 rounded-2xl px-4 py-3
                                 text-sm resize-none focus:outline-none focus:border-primary
                                 transition-all w-full"></textarea>
                    @error('question')
                    <span class="text-error text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="button" onclick="faq_modal.close()"
                            class="btn btn-ghost btn-sm rounded-full px-6 text-base-content/50">
                        Отмена
                    </button>
                    <button type="submit"
                            class="btn btn-primary btn-sm rounded-full px-7 text-white border-none shadow-lg">
                        Отправить вопрос →
                    </button>
                </div>
            </form>
        </div>
    </dialog>

@endsection
