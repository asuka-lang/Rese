@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <p class="heading-logo">Login</p>
    </div>
    <div class="login__inner">
        @if(Request::is('admin/*'))
        <form class="login__form" action="/admin/login" method="post">
        @elseif(Request::is('manager/*'))
        <form class="login__form" action="/manager/login" method="post">
        @else
        <form class="login__form" action="/login" method="post">
        @endif
            @csrf
            <table class="form__table">
                <tr class="form__table__row">
                    <td class="img"><i class="fa-solid fa-envelope email-icon"></i></td>
                    <td class="input"><input class="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" /></td>
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
            <div class="login__submit">
                @if(Request::is('admin/*'))
                <a class="submit__button--red" href="/admin/register">登録</a>
                @endif
                <button class="submit__button" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection