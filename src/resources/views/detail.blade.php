@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop__content">
    <div class="shop__detail">
        <div class="shop__ttl">
            <button class="back__button" onClick="history.back();">&lt;</button>
            <span class="name">{{ $shop['title'] }}</span>
        </div>
        <div class="shop__image">
            <img class="shop__img" src="{{ asset('storage/shop-img/'.$shop['image']) }}" alt="画像" />
        </div>
        <div class="shop__category">
            <p class="shop__area">#{{ $shop['area']['name'] }}</p>
            <p class="shop__genre">#{{ $shop['genre']['name'] }}</p>
        </div>
        <div class="shop__information">
            <p class="text">{{ $shop['information'] }}</p>
        </div>
    </div>
    <div class="shop__reserve">
        <form class="reserves__form" action="/done" method="post">
            @csrf
            @guest
            <input type="hidden" name="user_id" value="" />
            @endguest
            @auth
            <input type="hidden" name="user_id" value="{{ $user['id'] }}" />
            @endauth
            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}" />
            <div class="reserves">
                <h2 class="reserves__ttl">予約</h2>
                <div class="reserves__date">
                    <input id="inputDate" class="input__date" type="date" name="date" value="{{ $today->format('Y-m-d') }}" />
                </div>
                @error('date')
                <div class="reserves__alert">
                    <p class="reserves__alert-message">
                        {{ $message }}
                    </p>
                </div>
                @enderror
                <div class="reserves__time">
                    <select id="inputTime" class="select__time" name="time">
                        <option value="">00:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                    </select>
                </div>
                @error('time')
                <div class="reserves__alert">
                    <p class="reserves__alert-message">
                        {{ $message }}
                    </p>
                </div>
                @enderror
                <div class="reserves__number">
                    <select id="inputNumber" class="select__number" name="number">
                        <option value="">人数</option>
                        <option value="1人">1人</option>
                        <option value="2人">2人</option>
                        <option value="3人">3人</option>
                        <option value="4人">4人</option>
                        <option value="5人">5人</option>
                        <option value="6人">6人</option>
                    </select>
                </div>
                @error('number')
                <div class="reserves__alert">
                    <p class="reserves__alert-message">
                        {{ $message }}
                    </p>
                </div>
                @enderror
                <div class="reserves__box">
                    <table class="reserves__box-inner">
                        <tr class=" reserves__row">
                            <td class="column">Shop</td>
                            <td class="ttl">{{ $shop['title'] }}</td>
                        </tr>
                        <tr class="reserves__row">
                            <td class="column">Date</td>
                            <td class="date"></td>
                        </tr>
                        <tr class="reserves__row">
                            <td class="column">Time</td>
                            <td class="time"></td>
                        </tr>
                        <tr class="reserves__row">
                            <td class="column">Number</td>
                            <td class="number"></td>
                        </tr>
                    </table>
                </div>
                @error('user_id')
                <div class="reserves__alert">
                    <p class="reserves__alert-message">
                        {{ $message }}
                    </p>
                </div>
                @enderror
            </div>
            <div class="reserves__submit">
                <button class="reserves__button">予約する</button>
            </div>
        </form>
    </div>
</div>
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
@endsection