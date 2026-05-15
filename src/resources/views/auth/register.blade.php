@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="register__content">
        <div class="register__heading">
            <p class="heading-logo">Registration</p>
        </div>
        <div class="register__inner">
            @if(Request::is('admin/*'))
            <form class="register__form" action="/admin/register" method="post">
            @else
            <form class="register__form" action="/thanks" method="post">
            @endif
                @csrf
                <table class="form__table">
                    <tr class="form__table__row">
                        <td class="img"><img class=" user-icon" src="{{ asset('img/user.jpg') }}" alt="" />
                        </td>
                        <td class="input"><input class="name" type="name" name="name" placeholder="Username" value="{{ old('name') }}" /></td>
                    </tr>
                    @error('name')
                    <tr class="form__error">
                        <td></td>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                    <tr class="form__table__row">
                        <td class="img"><img class="email-icon" src="{{ asset('img/mail.jpg') }}" alt="" /></td>
                        <td class="input"><input class="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" /></td>
                    </tr>
                    @error('email')
                    <tr class="form__error">
                        <td></td>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                    <tr class="form__table__row">
                        <td class="img"><img class="pass-icon" src="{{ asset('img/pass.jpg') }}" alt="" /></td>
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
@endsection