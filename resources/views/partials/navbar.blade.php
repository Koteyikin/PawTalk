<div class="navbar absolute top-0 left-0 right-0 z-10 px-8 py-4 bg-transparent">
    <div class="navbar-start">
        <a class="font-display text-2xl font-bold text-white flex items-center gap-2">
            🐾 PetSpace
        </a>
    </div>
    @guest()
        <div class="navbar-end gap-2">
        <a href="#" onclick="my_modal_1.showModal()" class="btn btn-primary btn-sm rounded-full px-6 text-white border-none shadow-lg">
            Войти
        </a>
        <a href="#" onclick="my_modal_2.showModal()" class=" btn btn-primary btn-sm rounded-full px-6 text-white border-none shadow-lg">
            Зарегистрироваться
        </a>
    @else
    @endguest
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1 px-1">
            <li><a href="{{ route('profile.index') }}" class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">Профиль</a></li>
            <li><a href="{{ route('articles.index') }}" class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">Статьи</a></li>
            <li><a class="text-white/70 hover:text-white hover:bg-white/10 rounded-full text-xs uppercase tracking-widest font-semibold">Питомцы</a></li>
        </ul>
    </div>

            @include('partials.register.auth')
    </div>
</div>
