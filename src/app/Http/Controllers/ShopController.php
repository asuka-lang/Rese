<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $user = Auth::user();

        if($user){
            $shops = Shop::with('favorite')->get();
            return view('index',compact('shops','user'));
        }else{
            return view('index', compact('shops'));
        }
    }


    public function search(Request $request)
    {
        $shops = Shop::AreaSearch($request->area)->GenreSearch($request->genre)->KeywordSearch($request->keyword)->get();

        $user = Auth::user();

        if (!$user) {
            return view('index', compact('shops'));
        } else {
            $userId = $user->id;
            $favorites = Favorite::where('user_id', $userId)->get();
            foreach ($favorites as $favorite) {
                $fav_shop = $favorite->shop_id;
            }
            if ($fav_shop) {
                return view('index', compact('shops', 'fav_shop'));
            }
            return view('index', compact('shops'));
        }
    }



    public function detail(Request $request,$shop_id)
    {
        $shop = Shop::find($request->id);
        $today = new Carbon('today');

        $user = Auth::user();

        if(!$user){
            return view('detail',compact('shop','today'),['shop'=>$shop_id]);
        }else{
            return view('detail', compact('shop', 'today','user'), ['shop' => $shop_id]);
        }
    }

    public function done(ReserveRequest $request)
    {
        $reserve = $request->all();
        Reserve::create($reserve);
        return view('done');
    }

    public function like(Shop $shop)
    {
        $favorite = New Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();
        return back();
    }

    public function unlike(Shop $shop)
    {
        $user = Auth::user()->id;
        $favorite = Favorite::where('shop_id',$shop->id)->where('user_id',$user)->first();
        $favorite->delete();
        return back();
    }
}
