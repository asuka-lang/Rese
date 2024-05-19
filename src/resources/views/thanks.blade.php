<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
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
    <div class="thanks__content">
        <div class="thanks__message">
            <p class="registered">
                会員登録ありがとうございます
            </p>
        </div>
        <div class="login__button">
            <a href="/login">
                <button class="login">ログインする</button>
            </a>
        </div>
    </div>

</body>