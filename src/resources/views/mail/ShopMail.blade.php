@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mailSend.css') }}">
@endsection

@section('content')
<div class="mail-content">
    <h2 class="title">メール配信フォーム</h2>
    <span class="nav">
        ※こちらは店舗への配信専用となります。ユーザーへの配信は
        <a class="link" href="/admin/mail/user">こちら</a>
    </span>
    <form class="shopMail-form" action="/admin/mail/shop" method="post">
        @csrf
        <label class="label__name" for="name">宛先</label>
        <div class="select__name">
            <select id="ManagerEmail" class="name" name="email" id="name">
                <option value=""></option>
                @foreach($managers as $manager)
                <option value="{{$manager['email']}}">
                    {{$manager['name']}}
                </option>
                @endforeach
            </select>
            @error('email')
            <p class="name-error">{{$message}}</p>
            @enderror
            <span class="email4"></span>
        </div>
        <button id="ManagerCC" class="cc" type="button">CC</button>
        <div class="select__name" id="manager2" style="display: none;">
            <select id="ManagerEmail2" class="name" name="email2">
                <option value=""></option>
                @foreach($managers as $manager)
                <option value="{{$manager['email']}}">
                    {{$manager['name']}}
                </option>
                @endforeach
            </select>
            <span class="email5"></span>
        </div>
        <button id="ManagerBCC" class="bcc" type="button">BCC</button>
        <div class="select__name" id="manager3" style="display: none;">
            <select id="ManagerEmail3" class="name" name="email3">
                <option value=""></option>
                @foreach($managers as $manager)
                <option value="{{$manager['email']}}">
                    {{$manager['name']}}
                </option>
                @endforeach
            </select>
            <span class="email6"></span>
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
        @if(session('success2'))
        <div class="message">
            {{session('success2')}}
        </div>
        @endif
    </form>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        //CCボタンクリック
        const ManagerCC = document.getElementById('ManagerCC');
        const manager2 = document.getElementById('manager2');
        if (ManagerCC && manager2) {
            ManagerCC.addEventListener('click', () => {
                manager2.style.display =
                    (manager2.style.display === 'none' || manager2.style.display === '') ?
                    'block' :
                    'none';
            });
        }
        //BCCボタンクリック
        const ManagerBCC = document.getElementById('ManagerBCC');
        const manager3 = document.getElementById('manager3');
        if (ManagerBCC && manager3) {
            ManagerBCC.addEventListener('click', () => {
                manager3.style.display =
                    (manager3.style.display === 'none' || manager3.style.display === '') ?
                    'block' :
                    'none';
            });
        }
        //宛先のアドレスをプルダウン選択後表示
        const email = document.getElementById('ManagerEmail');
        if (email) {
            email.addEventListener('change', (event) => {
                document.querySelector('.email4').textContent = event.target.value;
            });
        }
        //CCのアドレスをプルダウン選択後表示
        const email2 = document.getElementById('ManagerEmail2');
        if (email2) {
            email2.addEventListener('change', (event) => {
                document.querySelector('.email5').textContent = event.target.value;
            });
        }
        //BCCのアドレスをプルダウン選択後表示
        const email3 = document.getElementById('ManagerEmail3');
        if (email3) {
            email3.addEventListener('change', (event) => {
                document.querySelector('.email6').textContent = event.target.value;
            });
        }

    });
</script>
@endsection