@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')
<div class="shop-reserve__content">
    <div class="shop-reserve__ttl">
        <button class="back__button" onClick="history.back();">&lt;</button>
        <span class="ttl">予約情報</span>
    </div>
    @if($reserves->count() > 0)
    <div class="shop-reserves">
        <table class="shop-reserves__box">
            <thead class="box__header">
                <tr class="header-name">
                    <th class="user">User</th>
                    <th class="date">Date</th>
                    <th class="time">Time</th>
                    <th class="number">Number</th>
                    <th class="other"></th>
                </tr>
            </thead>
            <tbody class="box-body">
                @foreach($reserves as $reserve)
                <tr class="box-inner">
                    <td class="data" data-label="User">{{ $reserve['user']['name'] }}</td>
                    <td class="data" data-label="Date">{{ $reserve['date'] }}</td>
                    <td class="data" data-label="Time">{{ substr($reserve['time'],0,5) }}</td>
                    <td class="data" data-label="Number">{{ $reserve['number'] }}</td>
                    @if($reserve->price && !$reserve->is_paid)
                    <td class="price-data">¥{{ number_format($reserve['price']) }}</td>
                    @elseif($reserve->price && $reserve->is_paid)
                    <td class="payment-completed">決済完了</td>
                    @elseif(!$reserve->price && $reserve->checkin_at)
                    <td class="price-form">
                        <button class="price-btn" data-id="{{ $reserve['id'] }}">料金を入力する</button>
                        <div id="{{ $reserve['id'] }}" class="price-modal">
                            <div class="modal-overlay"></div>
                            <div class="price-content">
                                <button class="close" data-id="{{ $reserve['id'] }}">×</button>
                                <p class="price-ttl">＜本日の利用料金＞</p>
                                <p class="price-user">{{ $reserve['user']['name'] }} 様</p>
                                <form class="form" action="{{ route('store.price') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reserve['id'] }}" />
                                    <label for="price" class="currency">¥</label>
                                    <input class="amount" type="number" name="price" required>
                                    <p class="caution">※半角数字で入力してください。</p>
                                    <button class="submit" type="submit">保存する</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    @else
                    <td class="checkIn">
                        <a href="{{ route('store.checkin') }}" class="toCheckIn-page">
                            Check in
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="not-reserve">予約がありません</p>
    @endif
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('.price-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById(`${id}`).classList.add('active');
            });
        });

        document.querySelectorAll('.close').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById(`${id}`).classList.remove('active');
            });
        });

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function() {
                const modal = this.closest('.price-modal');
                if (modal) modal.classList.remove('active');
            });
        });

    });
</script>
@endsection