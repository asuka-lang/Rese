<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function manager()
    {
        $managerId = Auth::guard('manager')->user()->id;
        $managerData = Manager::find($managerId);

        $shop = Shop::with('manager','area', 'genre')->where('manager_id',$managerId)->first();

        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.manager',compact('managerData','shop','areas','genres'));
    }

    public function booking(){
        $manager = Auth::guard('manager')->user()->id;

        $shopId = Shop::where('manager_id', $manager)->first()->id;

        $reserves = Reserve::with('user')->where('shop_id', $shopId)->get();

        return view('manager.booking',compact('reserves'));

    }

    public function shopUpdate(Request $request, Shop $shop)
    {
        $image = $request->file('image');
        $shopId = $request->id;
        if(isset($image)){
            $path = $image->getClientOriginalName();
            $image->storeAs('public/shop-img',$path);
            $shop->where('id', $shopId)->update([
                'title' => $request->title,
                'area_id' => $request->area_id,
                'genre_id' => $request->genre_id,
                'information' => $request->information,
                'image' => $path
            ]);
        }else{
            $shop->where('id', $shopId)->update([
                'title' => $request->title,
                'area_id' => $request->area_id,
                'genre_id' => $request->genre_id,
                'information' => $request->information,
            ]);
        }
        return back()->with('ShopUpdate','内容を変更しました');
    }

    public function shopCreate(ShopRequest $request, Shop $shop)
    {
        $image = $request->file('image');
        $path = $image->getClientOriginalName();
        $image->storeAs('public/shop-img',$path);
        $shop->create([
            'title' => $request->title,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'manager_id' => $request->manager_id,
            'information' => $request->information,
            'image' => $path
        ]);

        return back();

    }


    public function savePrice(Request $request)
    {
        $reservation_id = $request->id;
        $reservation = Reserve::findOrFail($reservation_id);

        $reservation->price = $request->price;
        $reservation->save();

        return back();

    }

    public function checkin()
    {
        return view('manager.qr-checkin');
    }

    public function QrScan(Request $request)
    {
        $reservationId = $request->reservation_id;
        $ts = $request->ts;
        $sig = $request->sig;

        if(!$reservationId || !$ts || !$sig){
            return response()->json(['error' =>'QRデータが不完全です'],400);
        }

        // QR期限（5分以内）
        if(Carbon::now()->timestamp - $ts > 300){
            return response()->json(['error' => 'QRコードの有効期限切れです'],403);
        }

        // 署名検証
        $expectedSig = hash_hmac(
            'sha256',
            json_encode(['reservation_id' => $reservationId, 'ts' => $ts]),
            config('app.qr_secret') // app.php に設定
        );
        if(!hash_equals($expectedSig,$sig)){
            return response()->json(['error' => 'QR署名が不正です'],403);
        }

        // 予約IDチェック
        $reservation = Reserve::find($reservationId);
        if(!$reservation){
            return response()->json(['error' => '予約が見つかりません'], 404);
        }

        // すでにチェックイン済みか
        if($reservation->checkin_at){
            return response()->json(['error' => 'すでにチェックイン済みです'],409);
        }

        // チェックイン処理
        $reservation->checkin_at = Carbon::now();
        $reservation->save();

        return response()->json(['message' => 'チェックイン完了しました']);
    }
}
