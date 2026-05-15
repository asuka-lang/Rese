<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Models\User;
use App\Models\Manager;
use App\Mail\AdminMail;
use Mail;

class MailController extends Controller
{
    public function MailUser()
    {
        $users = User::all();

        return view('mail.UserMail',compact('users'));
    }

    public function MailShop()
    {
        $managers = Manager::all();

        return view('mail.ShopMail',compact('managers'));
    }

    public function sendUser(MailRequest $request)
    {
        $data = $request->all();

        Mail::to($data['email'])->cc($data['email2'])->bcc($data['email3'])->send(new AdminMail($data));

        return back()->with('success','送信しました');

    }

    public function sendShop(MailRequest $request)
    {
        $data = $request->all();

        Mail::to($data['email'])->cc($data['email2'])->bcc($data['email3'])->send(new AdminMail($data));

        return back()->with('success2', '送信しました');
    }
}

