<div class="navbar absolute top-0 left-0 right-0 z-10 px-8 py-4 bg-transparent">

    {{-- Лого --}}
    <div class="navbar-start">
        <a href="{{ route('home.index') }}"
           class="font-display text-2xl font-bold text-white flex items-center gap-2">
            🐾 PawTalk
        </a>
    </div>

    {{-- Центр — ссылки --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1 px-1">
            <li>
                <a href="{{ route('profile.index') }}"
                   class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">
                    Профиль
                </a>
            </li>
            <li>
                <a href="{{ route('articles.index') }}"
                   class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">
                    Статьи
                </a>
            </li>
            <li>
                <a href="{{ route('faq.index') }}"
                   class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">
                    FAQ
                </a>
            </li>
        </ul>
    </div>

    {{-- Конец — кнопки --}}
    <div class="navbar-end gap-2">
        @guest
            <a href="#" onclick="my_modal_1.showModal()"
               class="btn btn-sm rounded-full px-6 text-white border-white/25
                      hover:bg-white/10 hover:border-white/50 bg-transparent">
                Войти
            </a>
            <a href="#" onclick="my_modal_2.showModal()"
               class="btn btn-primary btn-sm rounded-full px-6 text-white border-none shadow-lg">
                Регистрация
            </a>
        @else
            {{-- Авторизован --}}
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button"
                     class="btn btn-ghost btn-circle avatar placeholder">
                    <div class="w-9 h-9 rounded-full bg-primary text-white font-bold flex items-center justify-center text-sm">
                        {{ mb_strtoupper(mb_substr(auth()->user()->nickname ?? 'U', 0, 1)) }}
                    </div>
                </div>
                <ul tabindex="0"
                    class="dropdown-content menu bg-base-200 rounded-2xl shadow-xl z-50 w-48 p-2 mt-2 border border-base-300">
                    <li>
                        <a href="{{ route('profile.index') }}"
                           class="text-sm font-semibold">
                            👤 Профиль
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           class="text-sm text-error">
                            🚪 Выйти
                        </a>
                    </li>
                </ul>
            </div>
        @endguest
    </div>

    {{-- Модалки --}}
    @include('partials.register.auth')
</div>
