<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

/**
 * どのビューでも使用できる変数を定義するサービスプロバイダ
 */
class VariableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // https://github.com/jenssegers/agent
        $agent = new Agent();
        view()->share('agent', $agent);
    }
}
