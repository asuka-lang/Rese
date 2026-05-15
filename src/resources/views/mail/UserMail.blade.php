@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mailSend.css') }}">
@endsection

@section('content')
<div class="mail-content">
    <h2 class="title">メール配信フォーム</h2>
    <span class="nav">
        ※こちらはユーザーへの配信専用となります。店舗への配信は
        <a class="link" href="/admin/mail/shop">こちら</a>
    </span>
    <form class="userMail-form" action="/admin/mail/user" method="post">
        @csrf
        <label class="label__name" for="name">宛先</label>
        <div class="select__name">
            <select id="UserEmail" class="name" name="email" id="name">
                <option value=""></option>
                @foreach($users as $user)
                <option value="{{$user['email']}}">
                    {{$user['name']}}
                </option>
                @endforeach
            </select>
            @error('email')
            <p class="name-error">{{$message}}</p>
            @enderror
            <span class="email"></span>
        </div>
        <button id="UserCC" class="cc" type="button">CC</button>
        <div class="select__name" id="user2" style="display: none;">
            <select id="UserEmail2" class="name" name="email2">
                <option value=""></option>
                @foreach($users as $user)
                <option value="{{$user['email']}}">
                    {{$user['name']}}
                </option>
                @endforeach
            </select>
            <span class="email2"></span>
        </div>
        <button id="UserBCC" class="bcc" type="button">BCC</button>
        <div class="select__name" id="user3" style="display: none;">
            <select id="UserEmail3" class="name" name="email3">
                <option value=""></option>
                @foreach($users as $user)
                <option value="{{$user['email']}}">
                    {{$user['name']}}
                </option>
                @endforeach
            </select>
            <span class="email3"></span>
        </div>
        <label class="label__ttl" for="title">件名</label>
        <input class="ttl" type="text" name="title" id="title" />
        @error('title')
        <p class="title-error">{{$message}}</p>
        @enderror
        <label class="label-text" for="text">本文</label>
        <textarea class="text" name="text" id="text"></textarea>
        @error('text')
        <p class="text-error">{{$message}}</p>
        @enderror
        <button class="submit" type="submit">送信</button>
        <a class="back" href="/admin">topへ戻る</a>
        @if(session('success'))
        <div class="message">
            {{session('success')}}
        </div>
        @endif
    </form>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        //CCボタンクリック
        const UserCC = document.getElementById('UserCC');
        const user2 = document.getElementById('user2');
        if (UserCC && user2) {
            UserCC.addEventListener('click', () => {
                user2.style.display =
                    (user2.style.display === 'none' || user2.style.display === '') ?
                    'block' :
                    'none';
            });
        }
        //BCCボタンクリック
        const UserBCC = document.getElementById('UserBCC');
        const user3 = document.getElementById('user3');
        if (UserBCC && user3) {
            UserBCC.addEventListener('click', () => {
                user3.style.display =
                    (user3.style.display === 'none' || user3.style.display === '') ?
                    'block' :
                    'none';
            });
        }
        //宛先のアドレスをプルダウン選択後表示
        const email = document.getElementById('UserEmail');
        if (email) {
            email.addEventListener('change', (event) => {
                document.querySelector('.email').textContent = event.target.value;
            });
        }
        //CCのアドレスをプルダウン選択後表示
        const email2 = document.getElementById('UserEmail2');
        if (email2) {
            email2.addEventListener('change', (event) => {
                document.querySelector('.email2').textContent = event.target.value;
            });
        }
        //BCCのアドレスをプルダウン選択後表示
        const email3 = document.getElementById('UserEmail3')
        if (email3) {
            email3.addEventListener('change', (event) => {
                document.querySelector('.email3').textContent = event.target.value;
            });
        }

    });
</script>
@endsection