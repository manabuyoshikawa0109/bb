<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\InformationController;

/*
|--------------------------------------------------------------------------
| 一般ユーザー用ルーティング
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {
    // ログアウト
    Route::any ('logout', [LoginController::class, 'destroy'])->name('logout');

    // トップ
    Route::get ('/', [TopController::class, 'index'])->name('top');

    // お知らせ
    Route::controller(InformationController::class)->prefix('information')->name('information.')->group(function() {
        Route::any ('list',                 'list')->name('list');
        Route::get ('{information}/detail', 'detail')->name('detail');
    });

    // 未ログイン時専用
    Route::middleware(['guest:user'])->group(function () {
        // ログイン情報入力
        Route::controller(LoginController::class)->prefix('login')->name('login.')->group(function() {
            Route::get  ('/', 'create')->name('create');
            Route::post ('/', 'store')->name('store');
        });
    });

    // ログイン後専用
    Route::middleware(['auth:user'])->group(function () {
        // ホーム画面
        Route::get ('home', [HomeController::class, 'index'])->name('home.index');
    });
});
