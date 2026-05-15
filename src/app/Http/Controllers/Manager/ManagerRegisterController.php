<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use App\Actions\Manager\CreateNewManager;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;

class ManagerRegisterController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }


    /**
     * Create a new registered user.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @param  \App\Actions\Manager\CreateNewManager  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(
        RegisterRequest $request,
        CreateNewManager $creator
    ) {
        event(new Registered($creator->create($request->all())));

        return redirect(RouteServiceProvider::ADMIN_HOME)->with('newManager','新規登録完了しました');
    }

}
