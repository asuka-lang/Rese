@component('mail::message')
# 予約リマインダーのお知らせ

**{{ $reservation->user->name }}様**

いつもご利用ありがとうございます。

予約日のお知らせをいたします。

**【予約内容】**
### Shop::{{ $reservation->shop->title }}
### Date::{{ $reservation->date }}
### Time::{{ $reservation->time }}
### Number::{{ $reservation->number }}

ご不明な点がございましたら、お気軽にお問い合わせください。

よろしくお願いいたします。

{{ config('app.name') }}
@endcomponent

