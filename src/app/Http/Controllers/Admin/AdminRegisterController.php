<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use App\Http\Requests\RegisterRequest;
use App\Actions\Admin\CreateNewAdmin;
use App\Providers\RouteServiceProvider;


class AdminRegisterController extends Controller
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
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create()
    {
        return view('auth.register', ['guard' => 'admin']);
    }

    /**
     * Create a new registered user.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @param  App\Actions\Admin\CreateNewAdmin $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(
        RegisterRequest $request,
        CreateNewAdmin $creator
    ) {
        event(new Registered($admin = $creator->create($request->all())));

        $this->guard->login($admin);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}

