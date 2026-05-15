@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="checkout__content">
    <div class="check-mark">✔︎</div>
    <h1 class="success">
        お支払いが完了しました
    </h1>
    <h2 class="message">
        ご利用ありがとうございました。
        <br />決済が正常に処理されました。
    </h2>
    <div class="mypage-link">
        <a href="/mypage" class="mypage-btn">マイページへ戻る</a>
    </div>
</div>
@endsection