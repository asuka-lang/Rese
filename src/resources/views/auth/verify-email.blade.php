@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email__message">
    <p class="message-ttl">
        メールアドレス認証のお願い
    </p>
    <p class="message-text">
        ご入力いただいたメールアドレスへ認証リンクを送信しました。メールを確認し手続きを行ってください。<br>
        <span class="resend-message">
            もし、認証メールが届かない場合は再送させていただきますので以下のボタンをクリックしてください。
        </span>
    </p>
</div>
@if (session('status') == 'verification-link-sent')
<div class="send-message">
    新しい認証メールが送信されました。
</div>
@else
<div class="verification-resend">
    <form method="POST" action="/email/verification-notification">
        @csrf
        <button type="submit" class="resend-btn">認証メールを再送</button>
    </form>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="logout-btn">ログアウト</button>
    </form>
</div>
@endif
@endsection