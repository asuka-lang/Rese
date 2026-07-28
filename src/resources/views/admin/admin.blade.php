@extends('layouts.menubar')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h1 class="adminName">{{ $adminData['name'] }}さん</h1>
<div class="shop-data__content">
    <div class="content-header">
        <p class="all-shops">管理店舗一覧</p>
        <button class="manager-register">新規登録</button>
        <div class="modal" id="manager">
            <div class="overlay"></div>
            <div class="register__content">
                <button class="register__close">×</button>
                <div class="register__heading">
                    <p class="heading-logo">Registration</p>
                </div>
                <div class="register__inner">
                    <form class="register__form" action="/manager/register" method="post">
                        @csrf
                        <table class="form__table">
                            <tr class=" form__table__row">
                                <td class="img"><i class="fa-solid fa-user user-icon"></i></td>
                                <td class="input"><input class="name" type="text" name="name" placeholder="Username" /></td>
                            </tr>
                            @error('name')
                            <tr class="form__error">
                                <td></td>
                                <td>{{ $message }}</td>
                            </tr>
                            @enderror
                            <tr class="form__table__row">
                                <td class="img"><i class="fa-solid fa-envelope email-icon"></i></td>
                                <td class="input"><input class="email" type="email" name="email" placeholder="Email" /></td>
                            </tr>
                            @error('email')
                            <tr class="form__error">
                                <td></td>
                                <td>{{ $message }}</td>
                            </tr>
                            @enderror
                            <tr class="form__table__row">
                                <td class="img"><i class="fa-solid fa-lock pass-icon"></i></td>
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
        </div>
    </div>
    @if(session('newManager'))
    <div class="new-registered">
        {{ session('newManager') }}
    </div>
    @endif
    @if(session('ManagerUpdate'))
    <div class="update__manager">
        {{ session('ManagerUpdate')}}
    </div>
    @endif
    @if($errors->any())
    <div class="error-alert">
        入力エラーがあります。登録をやり直してください。
    </div>
    @endif
    <table class="data__table">
        <thead class="data__header">
            <tr class="columns">
                <th class="column1">No.</th>
                <th class="column2">店舗名</th>
                <th class="column3">地域</th>
                <th class="column4">ジャンル</th>
                <th class="column5" colspan="2">店舗代表者</th>
            </tr>
        </thead>
        <tbody class="data__body">
            @foreach($shops as $shop)
            <tr class="data">
                <td class="data1" data-label="No.">{{ $shop['id']}}</td>
                <td class="data2" data-label="店舗名">{{ $shop['title']}}</td>
                <td class="data3" data-label="地域">{{ $shop['area']['name']}}</td>
                <td class="data4" data-label="ジャンル">{{ $shop['genre']['name']}}</td>
                <td class="data5" data-label="店舗代表者">{{ $shop['manager']['name'] }}</td>
                <td class="data6">
                    <button class="detail-btn" data-shop-id="{{ $shop['id'] }}">詳細</button>
                    <div class="modal" id="{{ $shop['id'] }}">
                        <div class="shop-detail">
                            <button class="shop-close" data-shop-id="{{ $shop['id'] }}">×</button>
                            <div class="shop__image">
                                <img class="shop__img" src="{{ asset('storage/shop-img/'.$shop['image'] ) }}" alt="画像" />
                            </div>
                            <div class="shop__information">
                                {{ $shop['information'] }}
                            </div>
                        </div>
                    </div>
                    <button class="manager-update" data-manager-id="{{ $shop['manager']['name'] }}">代表者変更</button>
                    <div class="modal" id="{{ $shop['manager']['name'] }}">
                        <div class="overlay"></div>
                        <div class="update">
                            <button class="update-close" data-manager-id="{{ $shop['manager']['name'] }}">×</button>
                            <form class="update-form" action="{{ route('manager.edit',['id'=>$shop['manager']['id']]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-list">
                                    <p class="label">Name</p>
                                    <input class="update-text" type="text" name="name" value="{{ $shop['manager']['name'] }}" />
                                    @error('name')
                                    <p class="txt-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-list">
                                    <p class="label">Email</p>
                                    <input class="update-text" type="email" name="email" value="{{ $shop['manager']['email'] }}" />
                                    @error('email')
                                    <p class="txt-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-list">
                                    <p class="label">Password</p>
                                    <input class="update-text" type="password" name="password" />
                                    @error('password')
                                    <p class="txt-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button class="update-btn" type="submit">変更する</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">{{ $shops->links() }}</div>
</div>
@endsection
@section('script')
<script src="https://kit.fontawesome.com/6ab37a39bf.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        //新規登録(店舗代表者)画面を開く
        document.querySelector('.manager-register').
        addEventListener('click', function() {
            const manager = document.getElementById('manager');
            manager.classList.add('active');
        });
        //新規登録(店舗代表者)画面を閉じる(×ボタン)
        document.querySelector('.register__close').
        addEventListener('click', function() {
            const manager = document.getElementById('manager');
            manager.classList.remove('active');
        });
        //背景クリックしてモーダル画面を閉じる
        document.querySelectorAll('.overlay').forEach(overlay => {
            overlay.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) modal.classList.remove('active');
            });
        });
        //店舗詳細画面を開く
        document.querySelectorAll('.detail-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const shopId = this.dataset.shopId;
                document.getElementById(`${shopId}`).classList.add('active');
            });
        });
        //店舗詳細画面を閉じる(×ボタン)
        document.querySelectorAll('.shop-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const shopId = this.dataset.shopId;
                document.getElementById(`${shopId}`).classList.remove('active');
            });
        });
        //代表者変更画面を開く
        document.querySelectorAll('.manager-update').forEach(btn => {
            btn.addEventListener('click', function() {
                const managerId = this.dataset.managerId;
                document.getElementById(`${managerId}`).classList.add('active');
            });
        });
        //代表者変更画面を閉じる(×ボタン)
        document.querySelectorAll('.update-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const managerId = this.dataset.managerId;
                document.getElementById(`${managerId}`).classList.remove('active');
            });
        });

    });
</script>
@endsection