@extends('layouts.menubar')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
<script src="https://kit.fontawesome.com/6ab37a39bf.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="manager__content">
    <div class="manager__profile">
        <div class="profile-img">
            <img class="profile" src="{{ asset('img/profile_icon.jpg') }}" alt="アイコン" />
        </div>
        <div class="profile-data">
            <p class="profile-data__ttl">名前</p>
            <p class="profile-data__text">{{ $managerData['name'] }}</p>
            <p class="profile-data__ttl">メールアドレス</p>
            <p class="profile-data__text">{{ $managerData['email'] }}</p>
        </div>
    </div>
    <div class="shop-detail">
        @if($shop)
        <h2 class="detail-ttl">店舗情報
            @if(session('ShopUpdate'))
            <span class="update-message">{{ session('ShopUpdate') }}</span>
            @endif
        </h2>
        <div class="detail-box">
            <img class="image" src="{{ asset('storage/shop-img/'.$shop['image'] )}}" alt="店舗画像" />
            <div class="detail-data">
                <p class="shop-content">名称<span class="shop-data">{{ $shop['title'] }}</span></p>
                <p class="shop-content">地域<span class="shop-data">{{ $shop['area']['name'] }}</span></p>
                <p class="shop-content">ジャンル<span class="shop-data">{{ $shop['genre']['name'] }}</span></p>
                <p class="shop-content">Information</p>
                <span class="shop-data__text">{{ $shop['information'] }}</span>
            </div>
            <div class="update">
                <button class="update-btn" data-shop-id="{{ $shop['id'] }}">変更</button>
            </div>
            <div id="{{ $shop['id'] }}" class="update-detail">
                <div class="overlay"></div>
                <div class="detail">
                    <button class="update-close" data-shop-id="{{ $shop['id'] }}">×</button>
                    <form class="update-form" action="/manager/shops/update" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{ $shop['id'] }}" />
                        <p class="label">名称</p>
                        <input class="update-title" type="text" name="title" value="{{ $shop['title'] }}" />
                        <p class="label">地域</p>
                        <div class="update-select">
                            <select class="update-area" name="area_id">
                                <option value="{{ $shop['area_id'] }}">
                                    {{ $shop['area']['name'] }}
                                </option>
                                @foreach($areas as $area)
                                <option value="{{ $area['id'] }}">{{ $area['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="label">ジャンル</p>
                        <div class="update-select">
                            <select class="update-genre" name="genre_id">
                                <option value="{{ $shop['genre_id'] }}">
                                    {{ $shop['genre']['name'] }}
                                </option>
                                @foreach($genres as $genre)
                                <option value="{{ $genre['id'] }}">{{ $genre['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="label">Information</p>
                        <textarea class="update-information" name="information">{{ $shop['information'] }}</textarea>
                        <p class="label">トップ画像</p>
                        <input class="update-image" type="file" name="image" />
                        <button class="update-btn" type="submit">変更</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <h3 class="shop-register">店舗登録をしてください</h3>
        <form class="register__form" action="/manager/shops" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-inner">
                <input type="hidden" name="manager_id" value="{{ $managerData['id'] }}" />
                <p class="form-data">名称</p>
                <input class="name" type="text" name="title" placeholder="店舗名" />
                @error('title')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
                <p class="form-data">地域</p>
                <select class="area" name="area_id">
                    <option value="">選択してください</option>
                    @foreach($areas as $area)
                    <option value="{{ $area['id'] }}">{{ $area['name']}}</option>
                    @endforeach
                </select>
                @error('area_id')
                <div class="error-message">
                    {{ $message }}
                    @enderror
                    <p class="form-data">ジャンル</p>
                    <select class="genre" name="genre_id">
                        <option value="">選択してください</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['name']}}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                    <p class="form-data">Information</p>
                    <textarea class="information" name="information" placeholder="ここに店舗概要を入力"></textarea>
                    @error('information')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                    <p class="form-data">トップ画像</p>
                    <input class="shop-image" type="file" name="image" />
                    @error('image')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-button">
                        <button class="shop-register__submit">店舗登録する</button>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelector('.update-btn').
        addEventListener('click', function() {
            const shopId = this.dataset.shopId;
            document.getElementById(`${shopId}`).classList.add('active');
        });

        document.querySelector('.update-close').
        addEventListener('click', function() {
            const shopId = this.dataset.shopId;
            document.getElementById(`${shopId}`).classList.remove('active');
        });

        document.querySelector('.overlay').
        addEventListener('click', function() {
            const update = this.closest('.update-detail');
            if (update) update.classList.remove('active');
        });

    });
</script>
@endsection