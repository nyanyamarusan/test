<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1><a href="/" class="header__logo">FashionablyLate</a></h1>
            <nav>
                <ul class="header-nav">
                @yield('nav')
                @if (Auth::check())
                <li class="header-nav__item">
                    <form action="/logout" method="post">
                        @csrf
                        <button class="header-nav__button">logout</button>
                    </form>
                </li>
                @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>@yield('title')</h2>
        <div class="content">
        @yield('content')
        </div>
    </main>
</body>
</html>