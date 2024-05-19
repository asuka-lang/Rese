<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>

<body>
    <div class="detail-side">
        <header class="header">
            <div class="header__inner">
                <div class="homepage_ttl">
                    <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="rese" width="50" height="50" />
                    <div class="title">
                        <h1 class="ttl-name">Rese</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="shop__detail__content">
                <div class="shop__ttl">
                    <button class="back__button" onClick="history.back();">&lt;</button>
                    <span class="name">{{ $shop['title'] }}</span>
                </div>
                <div class="shop__image">
                    <img class="shop__img" src="{{ $shop['image'] }}" alt="image" />
                </div>
                <div class="shop__category">
                    <span class="shop__area">#{{ $shop['area'] }}</span>
                    <span class="shop__genre">#{{ $shop['genre'] }}</span>
                </div>
                <div class="shop__information">
                    <p class="text">{{ $shop['information'] }}</p>
                </div>
        </main>
    </div>
    <aside class=" reserves-side">
        <form class="reserves__form" action="/done" method="post">
            @csrf
            <div class="reserves">
                <h2 class="reserves__ttl">予約</h2>
                @guest
                <input type="hidden" name="user_id" value="" />
                @endguest
                @auth
                <input type="hidden" name="user_id" value="{{ $user['id'] }}" />
                @endauth
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}" />
                <input id="inputDate" class="input__date" type="date" name="date" value="{{ $today->format('Y-m-d') }}" />
                <select id="inputTime" class="select__time" name="time">
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                </select>
                <select id="inputNumber" class="select__number" name="number">
                    <option value="１人">１人</option>
                    <option value="２〜５人">２〜５人</option>
                    <option value="６人〜８人">６人〜８人</option>
                    <option value="９人〜１０人">９人〜１０人</option>
                </select>
                <div class="reserves__confirm">
                    <table class="confirm__box">
                        <tr class="confirm__row">
                            <td class="column">Shop</td>
                            <td class="ttl">{{ $shop['title'] }}</td>
                        </tr>
                        <tr class=" confirm__row">
                            <td class="column">Date</td>
                            <td class="date"></td>
                        </tr>
                        <tr class="confirm__row">
                            <td class="column">Time</td>
                            <td class="time"></td>
                        </tr>
                        <tr class="confirm__row">
                            <td class="column">Number</td>
                            <td class="number"></td>
                        </tr>
                    </table>
                </div>
                @error('user_id')
                <div class="reserves__alert">
                    <div class="reserves__alert-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
            <div class=" reserves__submit">
                <button class="reserves__button">予約する</button>
            </div>
        </form>
    </aside>
    <script type="text/javascript">
        document.getElementById('inputDate').addEventListener('input', (event) => {
            const count = document.querySelector('.date');
            count.textContent = event.target.value;
        });

        document.getElementById('inputTime').addEventListener('change', (event) => {
            const count = document.querySelector('.time');
            count.textContent = event.target.value;
        });

        document.getElementById('inputNumber').addEventListener('change', (event) => {
            const count = document.querySelector('.number');
            count.textContent = event.target.value;
        });
    </script>
</body>

</html>