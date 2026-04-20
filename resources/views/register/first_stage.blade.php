@guest()
    <button class="btn" onclick="my_modal_2.showModal()">Зарегистрироваться</button>
    <button class="btn" onclick="my_modal_1.showModal()">Войти</button>
@else
@endguest
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <div class="grid grid-cols-6 grid-rows-2">
            <div class="col-span-4 col-start-2 font-bold text-center h-min">Войти в аккаунт</div>
            <form action="{{ route('login.store') }}" method="post" class="col-span-4 col-start-2 row-start-2">
                @csrf
                <div class="mb-6">
                    <label for="email" class="floating-label">
                        <span>Ваш адрес электронной почты</span>
                        <input type="email" id="email" name="email" placeholder="test@gamil.com" class="input validator input-xl">
                        <span class="validator-hint hidden">Required</span>
                    </label>
                </div>
                <div class="mb-3">
                    <label for="password" class="floating-label">
                        <span>Ваш пароль</span>
                        <input type="password" id="password" name="password" placeholder="ваш пароль от аккаунта" class="input validator input-xl">
                        <span class="validator-hint hidden">Required</span>
                    </label>
                </div>
                <button class="btn btn-xl w-full">Продолжить общение</button>
            </form>

        </div>
    </div>
</dialog>
<dialog id="my_modal_2" class="modal">
    <div class="modal-box">
        <div class="grid grid-cols-6 grid-rows-2 gap-4">
            <div class="col-span-4 col-start-2 font-bold text-center h-min">Ключ от PawTalk</div>
            <form action="{{ route('register.store') }}" method="post" class="col-span-4 col-start-2 row-start-2">
                @csrf
                <div class="mb-6">
                    <label for="nickname" class="floating-label">
                        <span>Ваш псевдоним</span>
                        <input type="text" id="nickname" name="nickname" placeholder="Ваш псевдоним на сайте" class="input validator input-xl">
                        <span class="validator-hint hidden">Required</span>
                    </label>
                </div>
                <div class="mb-6">
                    <label for="email" class="floating-label">
                        <span>Ваш адрес электронной почты</span>
                        <input type="email" id="email" name="email" placeholder="test@gamil.com" class="input validator input-xl">
                        <span class="validator-hint hidden">Required</span>
                    </label>
                </div>
                <div class="mb-3">
                    <label for="password" class="floating-label">
                        <span>Ваш пароль</span>
                        <input type="password" id="password" name="password" placeholder="ваш пароль от аккаунта" class="input validator input-xl">
                        <span class="validator-hint hidden">Required</span>
                    </label>
                </div>
                <button class="btn btn-xl w-full">Создать аккаунт</button>
            </form>


            <div class="col-span-4 col-start-2 row-start-3">
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
