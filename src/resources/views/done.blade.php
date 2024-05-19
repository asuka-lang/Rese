<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
    <div class="done__content">
        <div class="done__message">
            <p class="reserved">
                ご予約ありがとうございます
            </p>
        </div>
        <div class="back__button">
            <a href="/">
                <button class="home">戻る</button>
            </a>
        </div>
    </div>

</body>