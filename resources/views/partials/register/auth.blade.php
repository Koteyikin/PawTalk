@guest()
    <dialog id="my_modal_1" class="modal modal-middle">
        <div class="modal-box rounded-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-3 top-3">✕</button>
            </form>
            <h3 class="text-xl font-bold mb-1" style="color:#4976F0;">Войти в аккаунт</h3>
            <p class="text-base-content/50 text-sm mb-6">Введите данные для входа</p>
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="flex flex-col gap-4">
                    <div class="form-control w-full">
                        <label for="email" class="label">
                            <span class="label-text font-medium">Электронная почта</span>
                        </label>
                        <input id="email" type="email" name="email" placeholder="you@example.com"
                               class="input input-bordered w-full"
                               onfocus="this.style.borderColor='#4976F0'" onblur="this.style.borderColor=''"/>
                    </div>
                    <div class="form-control w-full">
                        <label for="password" class="label">
                            <span class="label-text font-medium">Пароль</span>
                        </label>
                        <input id="password" type="password" name="password" placeholder="Ваш пароль"
                               class="input input-bordered w-full"
                               onfocus="this.style.borderColor='#4976F0'" onblur="this.style.borderColor=''"/>
                        <label class="label">
                            <a href="#" class="label-text-alt" style="color:#4976F0;">Забыли пароль?</a>
                        </label>
                    </div>
                </div>
                <div class="modal-action mt-2 flex-col gap-2">
                    <button type="submit" class="btn w-full text-white"
                            style="background-color:#4976F0; border-color:#4976F0;">
                        Войти
                    </button>
                    <p class="text-center text-sm text-base-content/40">
                        Нет аккаунта?
                        <a onclick="my_modal_1.close(); my_modal_2.showModal()" class="font-medium" style="color:#4976F0;">Зарегистрироваться</a>
                    </p>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>
    <dialog id="my_modal_2" class="modal modal-middle">
        <div class="modal-box rounded-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-3 top-3">✕</button>
            </form>
            <h3 class="text-xl font-bold mb-1" style="color:#4976F0;">Создать аккаунт</h3>
            <p class="text-base-content/50 text-sm mb-6">Заполните поля ниже для регистрации</p>
            <form action="{{ route('register.store') }}" method="post">
             @csrf
            <div class="flex flex-col gap-4">
                <div class="form-control w-full">
                    <label for="email" class="label">
                        <span class="label-text font-medium">Электронная почта</span>
                    </label>
                    <input
                           id="email"
                           type="email"
                           name="email"
                           placeholder="you@example.com"
                           class="input input-bordered w-full"
                           onfocus="this.style.borderColor='#4976F0'"
                           onblur="this.style.borderColor=''"
                    />
                </div>
                <div class="form-control w-full">
                    <label for="nickname" class="label">
                        <span class="label-text font-medium">Никнейм</span>
                    </label>
                    <input
                        id="nickname"
                        name="nickname"
                        type="text"
                        placeholder="cool_username"
                        class="input input-bordered w-full"
                        onfocus="this.style.borderColor='#4976F0'"
                        onblur="this.style.borderColor=''"/>
                </div>
                <div class="form-control w-full">
                    <label class="label" for="password">
                        <span class="label-text font-medium">Пароль</span>
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Минимум 8 символов"
                        class="input input-bordered w-full"
                        onfocus="this.style.borderColor='#4976F0'"
                        onblur="this.style.borderColor=''"/>
                    <label class="label">
                        <span class="label-text-alt text-base-content/40">Используйте буквы, цифры и символы</span>
                    </label>
                </div>
            <div class="modal-action mt-6 flex-col gap-2">
                <button  class="btn w-full text-white" style="background-color:#4976F0; border-color:#4976F0;">
                    Создать аккаунт
                </button>
                <p class="text-center text-sm text-base-content/40">
                    Уже есть аккаунт?
                    <a onclick="my_modal_2.close(); my_modal_1.showModal()" class="font-medium" style="color:#4976F0;">Войти</a>
                </p>
            </div>
        </div>
    </form>
        <!-- Закрытие по клику вне окна -->
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
        </div>
    </dialog>
@else
    <dialog id="my_modal_3" class="modal">
        <div class="modal-box">
            <div class="grid grid-cols-8 grid-rows-6 gap-4">
                <div class="col-span-4 col-start-3 font-bold text-center">Немного о себе</div>
                <div class="col-span-2 col-start-2 row-start-2">
                    <div class="mb-6">
                        <label for="name" class="floating-label">
                            <span>Ваше имя</span>
                            <input type="text" id="name" name="name" placeholder="Ваше имя" class="input validator input-sm">
                            <span class="validator-hint hidden">Required</span>
                        </label>
                    </div>
                </div>
                <div class="col-span-2 col-start-4 row-start-2">
                    <div class="mb-6">
                        <label for="surname" class="floating-label">
                            <span>Ваша фамилия</span>
                            <input type="text" id="surname" name="surname" placeholder="Ваша фамилия" class="input validator input-sm">
                            <span class="validator-hint hidden">Required</span>
                        </label>
                    </div>
                </div>
                <div class="col-span-2 col-start-6 row-start-2">
                    <div class="mb-6">
                        <label for="patronymic" class="floating-label">
                            <span>Ваше отчество</span>
                            <input type="text" id="patronymic" name="patronymic" placeholder="Ваше отчество" class="input validator input-sm">
                            <span class="validator-hint hidden">Required</span>
                        </label>
                    </div>
                </div>
                <div class="col-span-2 col-start-2 row-start-3">

                </div>
                <div class="col-span-2 col-start-6 row-start-3">7</div>
                <div class="col-span-2 col-start-4 row-start-3">8</div>
                <div class="col-span-2 row-span-2 col-start-2 row-start-4">9</div>
                <div class="col-span-4 row-span-2 col-start-4 row-start-4">10</div>
                <div class="col-span-6 col-start-2 row-start-6">11</div>
            </div>
        </div>
    </dialog>
@endguest

