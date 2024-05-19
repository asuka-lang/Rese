<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
    <div class="register__content">
        <div class="register__heading">
            <p class="heading-logo">Registration</p>
        </div>
        <div class="register__inner">
            <form class="register__form" action="/thanks" method="post">
                @csrf
                <table class="form__table">
                    <tr class="form__table__row">
                        <td class="img"><img class=" user-icon" src="{{ asset('img/user.jpg') }}" alt="" />
                        </td>
                        <td class="input"><input class="name" type="name" name="name" placeholder="Username" value="{{ old('name') }}" /></td>
                    </tr>
                    @error('name')
                    <tr class="form__error">
                        <td></td>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
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
                <div class="register__submit">
                    <button class="submit__button" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>

</body>