<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="close-form">
                <a href="/">
                    <button class="close-icon" type="button">×</button>
                </a>
            </div>
    </header>
    @guest
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="/">Home</a>
            </li>
            <li class="nav__item">
                <a href="/register">Registration</a>
            </li>
            <li class="nav__item">
                <a href="/login">Login</a>
            </li>
        </ul>
    </nav>
    @endguest
    @auth
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="/">Home</a>
            </li>
            <li class="nav__item">
                <form class="form" action="/logout" method="post">
                    @csrf
                    <button><a>Logout</a></button>
                </form>
            </li>
            <li class="nav__item">
                <a href="/mypage">Mypage</a>
            </li>
        </ul>
    </nav>
    @endauth
</body>

</html>