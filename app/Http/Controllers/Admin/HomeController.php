<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * ホーム画面
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function index(Request $request)
    {
        return view('admin.pages.home');
    }
}
