<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AdminRegisterController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use App\Actions\Admin\CreateNewAdmin;
use Illuminate\Support\ServiceProvider;

class AdminRegisterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
        ->when([AdminRegisterController::class, CreateNewAdmin::class])
        ->needs(StatefulGuard::class)
        ->give(function(){
            return Auth::guard('admin');
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
