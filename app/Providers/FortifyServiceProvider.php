<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use App\Responses\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * メモ：app.phpにはアプリへアクセス時に読み込むサービスの一覧が記述されている
     * その為サービスプロバイダーはアプリへアクセスした際に読み込まれる
     *
     * @return void
     */
    public function boot()
    {
        // 1. vendor/laravel/jetstream/src/JetstreamServiceProviderのbootメソッドに
        // Fortify::viewPrefix('auth.')という記述がある
        // 2. vendor/laravel/fortify/src/FortifyのviewPrefixメソッドには
        // static::loginView($prefix.'login')という記述がある
        // 3. vendor/laravel/fortify/src/FortifyのloginViewメソッドでは
        // サービスコンテナが定義されており、app(LoginViewResponse)が呼ばれると
        // SimpleViewResponseクラスで引数に渡されたビューを返すようになっている
        // 参考
        // ログイン処理：https://reffect.co.jp/laravel/laravel-jetstream
        // サービスコンテナ：https://reffect.co.jp/laravel/laravel-service-container-understand#singletonbind

        // ログイン用のビュー設定（デフォルトのオーバーライド）
        $view = 'user.pages.auth.login';
        if(request()->is('admin') || request()->is('admin/*')){
            $view = 'admin.pages.auth.login';
        }

        Fortify::loginView($view);

        // vendor/laravel/fortify/src/FortifyServiceProviderの80行目付近に
        // $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class)とある。
        // LoginControllerのdestroyメソッド呼び出し時にapp(LogoutResponse)と呼び出すことで
        // vendor/laravel/fortify/src/Http/LogoutResponseクラスを呼び出す。
        // その為App\Responses\LogoutResponseでvendor/laravel/fortify/src/Http/LogoutResponseを
        // オーバーライドする

        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
