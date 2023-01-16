<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\Information;

/*
|--------------------------------------------------------------------------
| 一般ユーザー用ルーティング
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {
    // ログアウト
    Route::any('logout', 'LoginController@destroy')->name('logout');

    // トップ
    Route::controller(TopController::class)->group(function() {

        Route::get  ('/', 'index')->name('top');

    });

    // お知らせ
    Route::controller(InformationController::class)->prefix('information')->name('information.')->group(function() {

        Route::get  ('/', 'detail')->name('detail');
        // モデル結合
        // Route::get  ('/{information}', 'detail')->name('detail');

    });

    // 未ログイン時専用
    Route::group(['middleware' => 'guest:user'], function() {

        // ログイン情報入力
        Route::get  ('login', 'LoginController@create')->name('login.create');
        Route::post ('login', 'LoginController@store')->name('login.store');
    });

    // ログイン後専用
    Route::group(['middleware' => 'auth:user'], function() {

        // ホーム画面
        Route::get  ('home', 'HomeController@show')->name('home.show');

    });
});
