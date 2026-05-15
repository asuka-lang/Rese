<?php

namespace App\Providers;

use  App\Http\Controllers\Manager\ManagerLoginController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use App\Actions\Manager\AttemptToAuthenticate;
use Illuminate\Support\ServiceProvider;

class ManagerLoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
        ->when([ManagerLoginController::class, AttemptToAuthenticate::class])
        ->needs(StatefulGuard::class)
        ->give(function(){
            return Auth::guard('manager');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
