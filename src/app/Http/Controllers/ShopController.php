<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::with('area', 'genre')->get();

        $user = Auth::user();

        if (!$user) {
            return view('index', compact('shops', 'areas', 'genres'));
        } else {
            $userId = $user->id;
            return view('index', compact('shops','user', 'userId','areas', 'genres'));
        }
    }

    public function search(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();

        $user = Auth::user();

        if (!$user) {
            return view('index', compact('shops', 'areas', 'genres'));
        } else {
            $userId = $user->id;
            return view('index', compact('shops', 'user','userId', 'areas', 'genres'));
        }
    }


    public function detail(Request $request,$shop_id)
    {
        $shop = Shop::with('area','genre')->find($request->id);
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
