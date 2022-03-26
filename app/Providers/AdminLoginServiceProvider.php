<?php

namespace App\Providers;

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use App\Actions\Admin\AttemptToAuthenticate;
use Illuminate\Support\ServiceProvider;

class AdminLoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // DI(依存性＝オブジェクトの注入)を行う
        // あるクラスを使用する時に、別のオブジェクトを渡してあげること
        // ここではサービスコンテナを結合(定義)している

        // 管理者用のLoginControllerと、AttemptToAuthenticateクラスの中で、
        // StatefulGuard::classがあればAuth::guard('admin')を返すという意味

        // 参考
        // DI：https://qiita.com/ritukiii/items/de30b2d944109521298f
        // https://qiita.com/minato-naka/items/afa4b930a2afac23261b

        // App\Http\Controllers\Admin\LoginControllerでログイン時に管理者のguardを付与
        $this->app
        ->when([LoginController::class, AttemptToAuthenticate::class])
        ->needs(StatefulGuard::class)
        ->give(function () {
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
