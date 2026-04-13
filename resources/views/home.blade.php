@extends('layouts.main')
@section('title', 'Главная страничка')
@section('body')
    <div class="grid grid-rows-6 grid-cols-1 bg-[url(/img/back.jpg)] bg-local">

        <div class="grid grid-cols-12 grid-rows-9 gap-4 bg-(--color-primary-content) rounded-xl mb-3 mt-3 ">
            <div class="col-span-6 col-start-4 row-start-3">2</div>
            <div class="col-span-6 col-start-4 row-start-4">3</div>
            <div class="col-span-6 col-start-4 row-start-5">4</div>
        </div>

        <div class="grid grid-cols-12 grid-rows-7 gap-1 bg-white rounded-xl mb-3">
            <div class="col-span-6 col-start-4 row-start-2">Заголовок</div>
            <div class="col-span-2 row-span-3 col-start-2 row-start-4">Первый этап</div>
            <div class="col-span-2 row-span-3 col-start-6 row-start-4">Второй этап</div>
            <div class="col-span-2 row-span-3 col-start-10 row-start-4">Третий этап</div>
        </div>
        <div class="grid grid-cols-12 grid-rows-7 gap-1 bg-white rounded-xl mb-3">
            <div class="col-span-6 col-start-4 row-start-2">Заголовок</div>
            <div class="col-span-2 row-span-3 col-start-2 row-start-4">Первая функция</div>
            <div class="col-span-2 row-span-3 col-start-6 row-start-4">Вторая функция</div>
            <div class="col-span-2 row-span-3 col-start-10 row-start-4">Третья функция</div>
        </div>

        <div class="grid grid-cols-12 grid-rows-8 gap-1 bg-white rounded-xl mb-3">
            <div class="col-span-6 col-start-4">Лента акивностей</div>
            <div class="col-span-10 row-span-2 col-start-2 row-start-3">Первый пост</div>
            <div class="col-span-10 row-span-2 col-start-2 row-start-5">Второй пост</div>
            <div class="col-span-10 row-span-2 col-start-2 row-start-7">Подробней</div>
        </div>

        <div class="grid grid-cols-12 grid-rows-8 gap-1 bg-white rounded-xl mb-3">
            <div class="col-span-6 col-start-4">Статистика</div>
            <div class="col-span-2 row-span-3 col-start-2 row-start-3">Сколько пользователей</div>
            <div class="col-span-2 row-span-3 col-start-5 row-start-5">Сколько питомцев на сайте</div>
            <div class="col-span-2 row-span-3 col-start-8 row-start-4">Сколько постов на сайте</div>
            <div class="col-span-2 row-span-3 col-start-11 row-start-3">Со скольки городов пользователи</div>
        </div>
        <div class="grid grid-cols-12 grid-rows-8 gap-1 bg-white rounded-xl mb-3">
            <div class="col-span-6 col-start-4">Присоединяйтесь к нам</div>
            <div class="col-span-10 row-span-6 col-start-2 row-start-2">
                <div class="grid grid-cols-12 grid-rows-8 gap-1">
                    <div class="col-span-8 col-start-3 row-start-3">24</div>
                    <div class="col-span-8 col-start-3 row-start-4">25</div>
                    <div class="col-span-4 col-start-5 row-start-6">26</div>
                </div>
            </div>
        </div>

    </div>


@endsection
