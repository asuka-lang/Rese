<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <script src="https://kit.fontawesome.com/6ab37a39bf.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="homepage-ttl">
                <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="rese" width="50" height="50" />
                <div class="title">
                    <h1 class="ttl-name">Rese</h1>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="user">
            <h1 class="user__name">{{ $user['name'] }}さん</h1>
        </div>
        <div class="my__contents">
            <div class="my__reserves">
                <h2 class="reserves-status">予約状況</h2>
                @foreach($reserves as $reserve)
                <div class="reserves-box">
                    <div class="box-header">
                        <div class="box-header__ttl">
                            <p class="reserves-icon">🕙</p>
                            <p class="reserves-count">予約{{ $reserve['id'] }}</p>
                        </div>
                        <form class="form" action="/mypage/unreserve" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $reserve['id'] }}" />
                            <button class="delete__button">
                                <span class="round_btn"></span>
                            </button>
                        </form>
                    </div>
                    <div class="box-inner">
                        <table class="reserves-table">
                            <tr class="reserves-table__row">
                                <td class="column">Shop</td>
                                <td class="data">{{ $reserve['shop']['title'] }}</td>
                            </tr>
                            <tr class="reserves-table__row">
                                <td class="column">Date</td>
                                <td class="data">{{ $reserve['date'] }}</td>
                            </tr>
                            <tr class="reserves-table__row">
                                <td class="column">Time</td>
                                <td class="data">{{ $reserve['time'] }}</td>
                            </tr>
                            <tr class="reserves-table__row">
                                <td class="column">Number</td>
                                <td class="data">{{ $reserve['number'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
            <div class=" my__favorites">
                <h2 class="favorites-shops">お気に入り店舗</h2>
                <div class="favorites-box">
                    @foreach($favorites as $favorite)
                    <div class="favorites-shop">
                        <div class="shop__image">
                            <img class="shop__img" src="{{ $favorite['shop']['image'] }}" alt="image" />
                        </div>
                        <div class="shop__text">
                            <h2 class="shop__title">{{ $favorite['shop']['title'] }}</h2>
                            <span class="shop__area">#{{ $favorite['shop']['area'] }}</span>
                            <span class="shop__genre">#{{ $favorite['shop']['genre'] }}</span>
                            <div class="buttons">
                                <form class="form" action="/detail/{shop_id}" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $favorite['shop']['id'] }}" />
                                    <button class="detail__btn" type="submit">詳しく見る</button>
                                </form>
                                <form class="form" action="/mypage/unfavorite" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $favorite['id'] }}" />
                                    <button class="favorite__btn" type="submit">
                                        <i class="fa-solid fa-heart fa-2x" style="color: rgb(229,75,76);"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>