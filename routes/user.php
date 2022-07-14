<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 一般ユーザー用ルーティング
|--------------------------------------------------------------------------
*/

// ログアウト
Route::any('logout', 'LoginController@destroy')->name('user.logout');

Route::get  ('/', 'TopController@index')->name('user.top');

// 未ログイン時専用
Route::group(['middleware' => 'guest:user'], function() {

    // ログイン情報入力
    Route::get  ('login', 'LoginController@create')->name('user.login.create');
    Route::post ('login', 'LoginController@store')->name('user.login.store');
});

// ログイン後専用
Route::group(['middleware' => 'auth:user'], function() {

    // ホーム画面
    Route::get  ('home', 'HomeController@show')->name('user.home.show');

});
