@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="checkout__content">
    <h1 class="cancel">
        キャンセルされました
    </h1>
    <h2 class="message">
        決済処理は完了していません。
        <br />再度決済をお試しください。
    </h2>
    <div class="mypage-link">
        <a href="/mypage" class="mypage-btn">マイページへ戻る</a>
    </div>
</div>
@endsection