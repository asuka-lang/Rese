<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Reserve;

class PaymentController extends Controller
{
    public function checkout(Reserve $reserve)
    {
        // 予約情報を取得
        $reservation = $reserve->load('shop');
        // Stripe 鍵設定
        Stripe::setApiKey(config('services.stripe.secret'));
        // Checkout セッション作成
        $session = Session::create([
            'payment_method_types' => ['card'], // カード
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $reservation->shop->title.'利用料金',
                    ],
                    'unit_amount' => $reservation->price, //金額 予約ごとに変動
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'reservation_id' => $reservation->id,
            ],
        ]);

        return redirect($session->url);

    }
}
