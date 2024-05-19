<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://kit.fontawesome.com/6ab37a39bf.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="login-form">
                <form class="form" action="/menu" method="get">
                    @csrf
                    <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="rese" width="50" height="50" />
                </form>
                <div class="title">
                    <h1 class="ttl-name">Rese</h1>
                </div>
            </div>
            <div class="search__form">
                <form class="form" action="/search" method="get">
                    @csrf
                    <table class="search__table">
                        <tr class="search__table-row">
                            <td class="search">
                                <select class="search-area" name="area">
                                    <option value="">All area</option>
                                    <option value="東京都">東京都</option>
                                    <option value="大阪府">大阪府</option>
                                    <option value="福岡県">福岡県</option>
                                </select>
                                <select class="search-genre" name="genre">
                                    <option value="">All genre</option>
                                    <option value="寿司">寿司</option>
                                    <option value="焼肉">焼肉</option>
                                    <option value="居酒屋">居酒屋</option>
                                    <option value="イタリアン">イタリアン</option>
                                    <option value="ラーメン">ラーメン</option>
                                </select>
                                <button class="search-button" type="submit">
                                    <div class="my-parts"><span></span></div>
                                </button>
                                <input class="search-text" type="search" name="keyword" placeholder="Search..." value="{{ old('keyword') }}" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
    </header>
    <main class="main">
        <div class="shop_all__content">
            @foreach($shops as $shop)
            <div class="shop">
                <div class="shop__image">
                    <img class="shop__img" src="{{ $shop['image'] }}" alt="image" />
                </div>
                <div class="shop__text">
                    <h2 class="shop__title">{{ $shop['title'] }}</h2>
                    <span class="shop__area">#{{ $shop['area'] }}</span>
                    <span class="shop__genre">#{{ $shop['genre'] }}</span>
                    <div class="buttons">
                        <form class="form" action="/detail/{shop_id}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ $shop['id'] }}" />
                            <button class="detail__btn" type="submit">詳しく見る</button>
                        </form>
                        @auth
                        @foreach($shop->favorite as $like)
                        <form class="form" action="{{ route('delete',$shop) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $like->id }}" />
                            <button class="favorite__btn" type="submit">
                                <i class="fa-solid fa-heart fa-2x" style="color: rgb(229,75,76);"></i>
                            </button>
                        </form>
                        @if($like->shop_id != $shop->id)
                        <form class="form" action="{{ route('favorite',$shop) }}" method="post">
                            @csrf
                            <button class="favorite__btn" type="submit">
                                <i class="fa-solid fa-heart fa-2x" style="color: #e8eaed;"></i>
                            </button>
                        </form>
                        @endif
                        @endforeach
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>

</html>