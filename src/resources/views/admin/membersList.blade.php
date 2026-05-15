@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/membersList.css') }}">
@endsection

@section('content')
<div class="members__contents">
    <div class="users__list">
        <button id="users__list" class="list-ttl" type="button">顧客リスト</button>
        <div id="users__table" class="users__table" style="display: none;">
            <table class="list-data">
                <thead class="data-header">
                    <tr class="header__row">
                        <th class="title1">No</th>
                        <th class="title2">顧客名</th>
                        <th class="title3">メールアドレス</th>
                        <th class="title4">利用履歴</th>
                    </tr>
                </thead>
                <tbody class="data-inner">
                    @foreach($users as $user)
                    <tr class="inner__row">
                        <td class="data1" data-label="No">{{ $user['id'] }}</td>
                        <td class="data2" data-label="顧客名">{{ $user['name'] }}</td>
                        <td class="data3" data-label="メールアドレス">{{ $user['email'] }}</td>
                        <td class="data4" data-label="利用履歴">
                            <button class="popover-btn" data-user-id="{{ $user['id'] }}">履歴を表示</button>
                            <div id="{{ $user['id'] }}" class="popover">
                                <div class="usage-history">
                                    <h4 class="usage-history__ttl">予約来店履歴</h4>
                                    <table class="usage-history__table">
                                        <tbody class="usage-history__data">
                                            @if($reserves->where('user_id',$user->id)->count() > 0)
                                            @foreach($reserves->where('user_id',$user->id) as $reserve)
                                            <tr class="data-row">
                                                <td class="date">
                                                    {{ $reserve['date']}}
                                                    <span class="shop">
                                                        {{ $reserve['shop']['title'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <p class="not-message">来店履歴がありません</p>
                                            @endif
                                        </tbody>
                                    </table>
                                    <button class="close" data-user-id="{{ $user['id'] }}">閉じる</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="managers__list">
        <button id="managers__list" class="list-ttl" type="button">店舗代表者リスト</button>
        <div id="managers__table" class="managers__table" style="display: none;">
            <table class="list-data">
                <thead class="data-header">
                    <tr class="header__row"">
                        <th class=" title1">No</th>
                        <th class="title2">代表者名</th>
                        <th class="title3">メールアドレス</th>
                        <th class="title4">店舗名称</th>
                    </tr>
                </thead>
                <tbody class="data-inner">
                    @foreach($shops as $shop)
                    <tr class="inner__row">
                        <td class="data1" data-label="No">{{ $shop['id'] }}</td>
                        <td class="data2" data-label="代表者名">{{ $shop['name'] }}</td>
                        <td class="data3" data-label="メールアドレス">{{ $shop['email'] }}</td>
                        @if(isset($shop->shop->id))
                        <td class="data4" data-label="店舗名称">{{ $shop->shop->title }}</td>
                        @else
                        <td class="data4" data-label="店舗名称">店舗未登録</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const users__list = document.getElementById('users__list');
        const users__table = document.getElementById('users__table');
        if (users__list && users__table) {
            users__list.addEventListener('click', () => {
                users__table.style.display =
                    (users__table.style.display === 'none' || users__table.style.display === '') ?
                    'block' :
                    'none';
            });
        }

        document.querySelectorAll('.popover-btn').forEach(btn => {
            const users__list = document.getElementById('users__list');
            const users__table = document.getElementById('users__table');
            if (users__list && users__table) {
                users__list.addEventListener('click', () => {
                    users__table.style.display =
                        (users__table.style.display === 'none' || users__table.style.display === '') ?
                        'block' :
                        'none';
                });
            }

            btn.addEventListener('click', function() {
                const userId = this.dataset.userId;
                document.getElementById(`${userId}`).classList.add('active');
            });
        });

        document.querySelectorAll('.close').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.dataset.userId;
                document.getElementById(`${userId}`).classList.remove('active');
            });
        });

        const managers__list = document.getElementById('managers__list');
        const managers__table = document.getElementById('managers__table');
        if (managers__list && managers__table) {
            managers__list.addEventListener('click', () => {
                managers__table.style.display =
                    (managers__table.style.display === 'none' || managers__table.style.display === '') ?
                    'block' :
                    'none';
            });
        }

    });
</script>
@endsection