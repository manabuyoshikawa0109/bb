<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 管理者用ルーティング
|--------------------------------------------------------------------------
*/

// ログアウト
Route::any('logout', 'LoginController@destroy')->name('admin.logout');

// 未ログイン時専用
Route::group(['middleware' => 'guest:admin'], function() {

    // ログイン情報入力
    Route::get  ('/', 'LoginController@create')->name('admin.login');
    Route::get  ('login', 'LoginController@create')->name('admin.login.create');
    Route::post ('login', 'LoginController@store')->name('admin.login.store');
});

// ログイン後専用
Route::group(['middleware' => 'auth:admin'], function() {

    // ホーム画面
    Route::get  ('home', 'HomeController@show')->name('admin.home.show');

    // 種目マスタ
    Route::group(['prefix' => 'event'], function() {
        Route::get  ('input', 'EventController@input')->name('admin.event.input');
        Route::post ('save',  'EventController@save')->name('admin.event.save');
    });

});
