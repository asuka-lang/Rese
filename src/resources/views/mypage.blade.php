@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<h1 class="user__name">{{ $user['name'] }}さん</h1>
@if(session('update'))
<div class="message">{{ session('update') }}</div>
@endif
@if(session('review'))
<div class="message">{{ session('review') }}</div>
@endif
@if(session('cancel'))
<div class="message">{{ session('cancel') }}</div>
@endif
@if(session('delete'))
<div class="message">{{ session('delete') }}</div>
@endif
<div class="my__contents">
    <div class="my__reserves">
        <h2 class="reserves-status">予約状況</h2>
        @if($reserves->count() > 0)
        <div class="reserves-box">
            @foreach($reserves as $reserve)
            <div class="box">
                <div class="box-header">
                    <div class="box-header__ttl">
                        <p class="reserves-icon">🕙</p>
                        <p class="reserves-count">予約{{ $reserve['id'] }}</p>
                        @if($reserve->date > $day or ($reserve->date == $day && $reserve->time > $time))
                        <button class="change-btn" data-id="{{ $reserve['id'] }}">
                            変更
                        </button>
                        @endif
                        <div id="reserve-{{ $reserve['id'] }}" class="modal">
                            <div class="modal-overlay"></div>
                            <div class="modal-content">
                                <button class="close" data-id="{{ $reserve['id'] }}">×</button>
                                <p class="reserve-id">予約{{ $reserve['id'] }}</p>
                                <form class="change-form" action="/mypage/update" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reserve['id'] }}" />
                                    <table class="form-table">
                                        <tr class="form-inner">
                                            <td class="update">Date</td>
                                            <td class="input">
                                                <input class="date" type="date" name="date" value="{{ $reserve['date'] }}" />
                                            </td>
                                        </tr>
                                        <tr class="form-inner">
                                            <td class="update">Time</td>
                                            <td class="input">
                                                <select class="time" name="time">
                                                    <option value="{{ $reserve['time'] }}">{{ substr($reserve['time'],0,5) }}</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-inner">
                                            <td class="update">Number</td>
                                            <td class="input">
                                                <select class="number" name="number">
                                                    <option value="{{ $reserve['number'] }}">{{ $reserve['number'] }}</option>
                                                    <option value="1人">1人</option>
                                                    <option value="2人">2人</option>
                                                    <option value="3人">3人</option>
                                                    <option value="4人">4人</option>
                                                    <option value="5人">5人</option>
                                                    <option value="6人">6人</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <button class="change" type="submit">変更</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(!$reserve->checkin_at)
                    <form class="form" action="/mypage/unreserve" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $reserve['id'] }}" />
                        <button class="delete__button" type="submit">
                            <span class="round_btn"></span>
                        </button>
                    </form>
                    @endif
                </div>
                <div class="box-inner">
                    <table class="reserves-table">
                        <tr class="reserves-table__row">
                            <td class="column">Shop</td>
                            <td class="data">{{ $reserve['shop']['title'] }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Date</td>
                            <td class="data">{{ $reserve['date'] }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Time</td>
                            <td class="data">{{ substr($reserve['time'],0,5) }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Number</td>
                            <td class="data">{{ $reserve['number'] }}</td>
                        </tr>
                        @if(!$reserve->checkin_at)
                        <tr class="reserves-table__row">
                            <td class="qr" colspan="2">
                                <button class="qr-btn" data-reserve-id="{{ $reserve['id'] }}">
                                    チェックインQR
                                </button>
                                <div id="qr-{{ $reserve['id'] }}" class="modal">
                                    <div class="modal-overlay"></div>
                                    <div class="modal-content">
                                        <button class="qr-close" data-reserve-id="{{ $reserve['id'] }}">×</button>
                                        <h3 class="qr-title">予約QRコード</h3>
                                        <img id="qrImage{{ $reserve['id'] }}" class="qr-image" alt="QRコード" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if($reserve->price)
                        <tr class="reserves-table__row">
                            <td class="price__column">利用料金</td>
                            <td class="price__data">¥{{ number_format($reserve['price']) }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="payment" colspan="2">
                                <a href="{{ route('payment.checkout',['reserve'=> $reserve->id ]) }}" class="payment-button">料金を支払う</a>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="not-reserves">予約がありません</p>
        @endif
        <h2 class="checkout-status">利用履歴</h2>
        @if($checkouts->count() > 0)
        <div class="checkout-box">
            @foreach($checkouts as $checkout)
            <div class="box">
                <div class="box-inner">
                    <table class="reserves-table">
                        <tr class="reserves-table__row">
                            <td class="column">Shop</td>
                            <td class="data">{{ $checkout['shop']['title'] }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Date</td>
                            <td class="data">{{ $checkout['date'] }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Time</td>
                            <td class="data">{{ substr($checkout['time'],0,5) }}</td>
                        </tr>
                        <tr class="reserves-table__row">
                            <td class="column">Number</td>
                            <td class="data">{{ $checkout['number'] }}</td>
                        </tr>
                        @if(!$checkout->is_reviewed)
                        <tr class="reserves-table__row">
                            <td class="review" colspan="2">
                                <button class="review-btn" data-checkout-id="{{ $checkout['id'] }}">
                                    レビューする
                                </button>
                                <div id="review-{{ $checkout['id'] }}" class="modal">
                                    <div class="modal-overlay"></div>
                                    <div class="modal-content">
                                        <button class="less" data-checkout-id="{{ $checkout['id'] }}">
                                            ×
                                        </button>
                                        <form class="review-form" action="/mypage/review" method="post">
                                            @csrf
                                            <p class="score">評価</p>
                                            <input type="hidden" name="reserve_id" value="{{ $checkout['id'] }}" />
                                            <input type="hidden" name="date" value="{{ $day }}" />
                                            <div class="review-select">
                                                <select class="five-stars" name="score">
                                                    <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                                                    <option value="4">⭐️⭐️⭐️⭐️</option>
                                                    <option value="3">⭐️⭐️⭐️</option>
                                                    <option value="2">⭐️⭐️</option>
                                                    <option value="1">⭐️</option>
                                                </select>
                                            </div>
                                            <p class="comment">コメント</p>
                                            <textarea class="comment-text" name="comment" placeholder="コメントする"></textarea>
                                            <button class="review-submit" type="submit">
                                                送信
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="not-checkouts">履歴がありません</p>
        @endif
    </div>
    <div class="my__favorites">
        <h2 class="favorites-shops">お気に入り店舗</h2>
        <div class="favorites-box">
            @foreach($favorites as $favorite)
            <div class="shop-box">
                <div class="shop__image">
                    <img class="shop__img" src="{{ asset('storage/shop-img/'.$favorite['shop']['image']) }}" alt="image" />
                </div>
                <div class="shop__text">
                    <h2 class="shop__title">{{ $favorite['shop']['title'] }}</h2>
                    <span class="shop__area">#{{ $favorite['shop']['area']['name'] }}</span>
                    <span class="shop__genre">#{{ $favorite['shop']['genre']['name'] }}</span>
                    <div class="buttons">
                        <form class="form" action="/detail/{shop_id}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ $favorite['shop']['id'] }}" />
                            <button class="detail__btn" type="submit">詳しく見る</button>
                        </form>
                        <form class="form" action="/mypage/unfavorite" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $favorite['id'] }}" />
                            <button class="favorite__btn" type="submit">
                                <i class="fa-solid fa-heart fa-2x" style="color: rgb(229,75,76);"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // モーダル制御（←ここに追加）
        document.querySelectorAll('.change-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById(`reserve-${id}`).classList.add('active');
            });
        });
        // 閉じる（×ボタン）
        document.querySelectorAll('.close').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById(`reserve-${id}`).classList.remove('active');
            });
        });
        // QRコード処理
        const qrApiBaseUrl = "{{ route('qrCode', ['id' => '__ID__']) }}";
        const statusApiBaseUrl = "/reservation/qr/__ID__/status";
        document.querySelectorAll('.qr-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const reserveId = this.dataset.reserveId;
                // 先にモーダル開く
                document.getElementById(`qr-${reserveId}`).classList.add('active');
                const url = qrApiBaseUrl.replace('__ID__', reserveId);
                fetch(url, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.qr_content) return;
                        QRCode.toDataURL(data.qr_content, function(err, qrUrl) {
                            if (err) return;
                            document.getElementById(`qrImage${reserveId}`).src = qrUrl;
                            // ✅ QR表示後に監視開始
                            startPolling(reserveId);
                        });
                    });
            });
        });
        // QRコードを閉じる
        document.querySelectorAll('.qr-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const reserveId = this.dataset.reserveId;
                document.getElementById(`qr-${reserveId}`).classList.remove('active');
                location.reload();
            });
        });

        // ✅ QR表示後に監視開始
        function startPolling(reserveId) {
            const interval = setInterval(() => {
                const url = statusApiBaseUrl.replace('__ID__', reserveId);
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (data.checked_in) {
                            clearInterval(interval);
                            // モーダル閉じる
                            document.getElementById(`qr-${reserveId}`).classList.remove('active');
                            // ✅ ページ再読み込み（簡単確実）
                            location.reload();
                        }
                    });
            }, 3000); // 3秒ごと
        }

        document.querySelectorAll('.review-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const checkoutId = this.dataset.checkoutId;
                document.getElementById(`review-${checkoutId}`).classList.add('active');
            });
        });

        document.querySelectorAll('.less').forEach(btn => {
            btn.addEventListener('click', function() {
                const checkoutId = this.dataset.checkoutId;
                document.getElementById(`review-${checkoutId}`).classList.remove('active');
            });
        });

        // 共通：overlayクリック
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) modal.classList.remove('active');
            });
        });

    });
</script>
@endsection