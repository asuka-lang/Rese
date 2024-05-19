<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function mypage()
    {
        $user = Auth::user();
        $userId = $user->id;

        $reserves = Reserve::where('user_id',$userId)->with('shop')->get();
        $favorites = Favorite::where('user_id',$userId)->with('shop')->get();

        return view('mypage',compact('user','reserves','favorites'));
    }

    public function cancel(Request $request)
    {
        Reserve::find($request->id)->delete();
        return redirect('/mypage');
    }


    public function delete(Request $request)
    {
        Favorite::find($request->id)->delete();
        return redirect('/mypage');
    }

}
