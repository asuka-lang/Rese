<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\Manager;
use App\Models\User;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function admin()
    {
        $shops = Shop::with('area', 'genre','manager')->paginate(10);
        $adminId =Auth::guard('admin')->user()->id;
        $adminData = Admin::find($adminId);
        return view('admin.admin',compact('adminData','shops'));
    }

    public function ManagerUpdate(RegisterRequest $request,$id)
    {
        Manager::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        return redirect('/admin')->with('ManagerUpdate','代表者変更しました');
    }

    public function list()
    {
        $users = User::all();

        $reserves = Reserve::with('shop')->whereNotNull('checkin_at')->get();

        $shops = Manager::with('shop')->get();

        return view('admin.membersList',compact('users','reserves','shops'));
    }
}

