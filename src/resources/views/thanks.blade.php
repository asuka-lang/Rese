@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
        <div class="thanks__message">
            <p class="registered">
                会員登録ありがとうございます
            </p>
        </div>
        <div class="login__button">
            <a href="/login">
                <button class="login">ログインする</button>
            </a>
        </div>
    </div>
@endsection
