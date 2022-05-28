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

    // 大会管理
    Route::group(['prefix' => 'tournament'], function() {
        Route::any  ('list', 'TournamentController@list')->name('admin.tournament.list');
        Route::get  ('add',  'TournamentController@add')->name('admin.tournament.add');
        Route::post ('create',  'TournamentController@create')->name('admin.tournament.create');
        Route::get  ('{tournament}/detail',  'TournamentController@detail')->name('admin.tournament.detail');
        Route::get  ('{tournament}/edit',  'TournamentController@edit')->name('admin.tournament.edit');
        Route::post ('{tournament}/update',  'TournamentController@update')->name('admin.tournament.update');
        Route::get  ('{tournament}/delete',  'TournamentController@delete')->name('admin.tournament.delete');
    });

    // 種目マスタ
    Route::group(['prefix' => 'event'], function() {
        Route::get  ('input', 'EventController@input')->name('admin.event.input');
        Route::post ('register',  'EventController@register')->name('admin.event.register');
    });

    // 場所マスタ
    Route::group(['prefix' => 'place'], function() {
        Route::get  ('input', 'PlaceController@input')->name('admin.place.input');
        Route::post ('register',  'PlaceController@register')->name('admin.place.register');
    });

});
