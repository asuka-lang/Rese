@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="done__content">
        <div class="done__message">
            <p class="reserved">
                ご予約ありがとうございます
            </p>
        </div>
        <div class="back__button">
            <a href="/dashboard">
                <button class="home">戻る</button>
            </a>
        </div>
    </div>
@endsection
