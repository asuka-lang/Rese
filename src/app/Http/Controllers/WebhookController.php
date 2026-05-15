<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use  App\Models\Reserve;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        // Stripe 署名秘密鍵（.env に設定）
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        // Log::info('Stripe Webhook received',['payload'=> $payload]);
        $sigHeader = $request->header('Stripe-Signature');

        try {
            // Stripe ライブラリで署名検証
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (\Exception $e) {
            // 署名が一致しない場合は拒否
            Log::error('Stripe Webhook signature error', [
                'message' => $e->getMessage(),
            ]);
            return response('Invalid signature', 400);
        }

        // イベントタイプの判定
        if($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // 🎯 Checkout で設定した metadata を取得
            $reservationId = $session->metadata->reservation_id ?? null;
            $paymentIntentId = $session->payment_intent;

            if($reservationId){
                $reservation = Reserve::find($reservationId);
                if ($reservation) {
                    $reservation->payment_intent_id = $paymentIntentId;
                    $reservation->is_paid = true;
                    $reservation->save();
                }
            }
        }

        return response('Webhook handled', 200);
    }
}
