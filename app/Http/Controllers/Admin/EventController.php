<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * 種目入力
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function input(Request $request)
    {
        return view('admin.pages.event.input');
    }

    /**
     * 種目登録
     * @param  Request $request
     * @return
     */
    public function save(Request $request)
    {
        // 完了メッセージをセット
        session()->flash('message', '種目を登録・更新しました。');
        return redirect()->route('admin.event.input');
    }
}
