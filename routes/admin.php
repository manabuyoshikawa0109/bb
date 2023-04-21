<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\TournamentController;


/*
|--------------------------------------------------------------------------
| 管理者用ルーティング
|--------------------------------------------------------------------------
*/

Route::name('admin.')->group(function () {

    Route::controller(LoginController::class)->group(function() {
        // ログアウト
        Route::any('logout', 'destroy')->name('logout');

        // 未ログイン時専用
        Route::middleware(['guest:admin'])->group(function () {
            // ログイン情報入力
            Route::get  ('/',     'create')->name('login');
            Route::get  ('login', 'create')->name('login.create');
            Route::post ('login', 'store')->name('login.store');
        });
    });

    // ログイン後専用
    Route::middleware(['auth:admin'])->group(function () {

        // ホーム画面
        Route::get  ('home', [HomeController::class, 'index'])->name('home.index');

        // 大会管理
        Route::controller(TournamentController::class)->prefix('tournament')->name('tournament.')->group(function() {
            Route::any  ('list',                 'list')->name('list');
            Route::get  ('add',                  'add')->name('add');
            Route::post ('create',               'create')->name('create');
            Route::get  ('{tournament}/detail',  'detail')->name('detail');
            Route::get  ('{tournament}/edit',    'edit')->name('edit');
            Route::post ('{tournament}/update',  'update')->name('update');
            Route::post ('{tournament}/delete',  'delete')->name('delete');
        });

        // お知らせ管理
        Route::controller(InformationController::class)->prefix('information')->name('information.')->group(function() {
            Route::any  ('list',                  'list')->name('list');
            Route::get  ('add',                   'add')->name('add');
            Route::post ('create',                'create')->name('create');
            Route::get  ('{information}/detail',  'detail')->name('detail');
            Route::get  ('{information}/edit',    'edit')->name('edit');
            Route::post ('{information}/update',  'update')->name('update');
            Route::post ('{information}/delete',  'delete')->name('delete');
        });

        // 種目マスタ
        Route::controller(EventController::class)->prefix('event')->name('event.')->group(function() {
            Route::any  ('list',           'list')->name('list');
            Route::get  ('add',            'add')->name('add');
            Route::post ('create',         'create')->name('create');
            Route::get  ('{event}/edit',   'edit')->name('edit');
            Route::post ('{event}/update', 'update')->name('update');
            Route::post ('{event}/delete', 'delete')->name('delete');
        });

        // 場所マスタ
        Route::controller(PlaceController::class)->prefix('place')->name('place.')->group(function() {
            Route::get  ('list',           'list')->name('list');
            Route::get  ('add',            'add')->name('add');
            Route::post ('create',         'create')->name('create');
            Route::get  ('{place}/edit',   'edit')->name('edit');
            Route::post ('{place}/update', 'update')->name('update');
            Route::post ('{place}/delete', 'delete')->name('delete');
        });

    });
});
