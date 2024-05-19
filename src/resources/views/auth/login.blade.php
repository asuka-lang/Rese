<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="homepage-ttl">
                <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="" width="50" height="50" />
                <div class="title">
                    <h1 class="ttl-name">Rese</h1>
                </div>
            </div>
        </div>
    </header>
    <div class="login__content">
        <div class="login__heading">
            <p class="heading-logo">Login</p>
        </div>
        <div class="login__inner">
            <form class="login__form" action="/login" method="post">
                @csrf
                <table class="form__table">
                    <tr class="form__table__row">
                        <td class="img"><img class="email-icon" src="{{ asset('img/mail.jpg') }}" alt="" /></td>
                        <td class="input"><input class="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" /></td>
                    </tr>
                    @error('email')
                    <tr class="form__error">
                        <td></td>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                    <tr class="form__table__row">
                        <td class="img"><img class="pass-icon" src="{{ asset('img/pass.jpg') }}" alt="" /></td>
                        <td class="input"><input class="password" type="password" name="password" placeholder="Password" /></td>
                    </tr>
                    @error('password')
                    <tr class="form__error">
                        <td></td>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                </table>
                <div class="login__submit">
                    <button class="submit__button" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>

</body>