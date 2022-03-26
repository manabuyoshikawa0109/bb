<?php

namespace App\Http\Controllers\User\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BbController extends Controller
{
    /**
     * 入力画面
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function input(Request $request)
    {
        return view('user.pages.enrty.bb.input');
    }
}
