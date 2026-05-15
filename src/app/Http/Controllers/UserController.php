<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use App\Models\Favorite;
use App\Models\Review;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();

        $userId = $user->id;
        $shops = Shop::with('area', 'genre', 'favorite')->get();

        return view('index', compact('shops', 'user', 'areas', 'genres', 'userId'));
    }

    public function mypage()
    {
        $user = Auth::user();
        $userId = $user->id;

        $now = new DateTime();
        $day = $now->format('Y-m-d');
        $time = $now->format('H:i');

        $reserves = Reserve::where('user_id',$userId)->where('is_paid','0')->with('shop')->get();
        $checkouts = Reserve::where('user_id',$userId)->where('is_paid','1')->with('shop')->get();
        $favorites = Favorite::where('user_id',$userId)->with('shop.area')->with('shop.genre')->get();

        return view('mypage',compact('user','reserves', 'checkouts','favorites', 'day','time'));
    }

    public function update(Request $request)
    {
        $reserve = $request->only(['date', 'time', 'number']);
        Reserve::find($request->id)->update($reserve);

        return redirect('/mypage')->with('update','予約内容変更しました');
    }

    public function review(Request $request)
    {
        $review = $request->all();
        Review::create($review);

        $reserveId = $request->reserve_id;
        $checkout = Reserve::findOrFail($reserveId);
        $checkout->is_reviewed = true;
        $checkout->save();

        return redirect('/mypage')->with('review','来店後のレビューがありました');
    }

    public function cancel(Request $request)
    {
        Reserve::find($request->id)->delete();
        return redirect('/mypage') ->with('cancel','予約を取消ました');
    }


    public function delete(Request $request)
    {
        Favorite::find($request->id)->delete();
        return redirect('mypage')->with('delete','お気に入りを取消ました');
    }

    public function generateQr($id)
    {
        $reservation = Reserve::findOrFail($id);

        // QRペイロード
        $payload = [
            'reservation_id' => $reservation->id,
            'ts' => time(), // 現在タイムスタンプ
        ];

        // HMAC署名（改ざん防止）
        $signature = hash_hmac(
            'sha256',
            json_encode($payload),
            config('app.qr_secret') // app.php に設定
        );

        $qrData = array_merge($payload, ['sig' => $signature]);

        // DB に保存
        $reservation->qr_token = $signature;
        $reservation->qr_token_expires_at = now()->addHours(2);
        $reservation->save();

        return response()->json([
            'qr_content' => json_encode($qrData),
        ]);
    }

    public function statusQr($id)
    {
        $reservation = Reserve::findOrFail($id);

        return response()->json([
            'checked_in' => !is_null($reservation->checkin_at)
        ]);
    }

}
