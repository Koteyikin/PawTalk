<!doctype html>
<html lang="ru" data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="color-baw min-h-screen bg-cover bg-center bg-no-repeat">
        @include('partials.navbar')
{{--    <div class="container mx-auto px-4">--}}

        @yield('body')
{{--    </div>--}}
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

</body>
</html>
