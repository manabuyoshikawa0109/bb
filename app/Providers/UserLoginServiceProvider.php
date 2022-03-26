<?php

namespace App\Providers;

use App\Http\Controllers\User\LoginController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Illuminate\Support\ServiceProvider;

class UserLoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // App\Http\Controllers\User\LoginControllerでログイン時に一般ユーザーのguardを付与
        $this->app
        ->when([LoginController::class, AttemptToAuthenticate::class])
        ->needs(StatefulGuard::class)
        ->give(function () {
            return Auth::guard('user');
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
