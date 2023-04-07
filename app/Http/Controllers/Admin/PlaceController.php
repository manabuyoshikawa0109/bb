<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SavePlaceRequest;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    /**
    * 場所一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        $places = Place::all();
        return view('admin.pages.place.list', compact('places'));
    }

    /**
    * 場所新規追加
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function add(Request $request)
    {
        $place = new Place();
        return view('admin.pages.place.input', compact('place'));
    }

    /**
    * 場所新規登録
    * @param  SavePlaceRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(SavePlaceRequest $request)
    {
        $place = new Place();
        $place->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', '場所情報を登録しました。');
        return redirect()->route('admin.place.list');
    }

    /**
    * 場所編集
    * @param  Request $request
    * @param  Place   $place
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function edit(Request $request, Place $place)
    {
        return view('admin.pages.place.input', compact('place'));
    }

    /**
    * 場所更新
    * @param  SavePlaceRequest $request
    * @param  Place   $place
    * @return \Illuminate\Http\Response
    */
    public function update(SavePlaceRequest $request, Place $place)
    {
        $place->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', '場所情報を更新しました。');
        return redirect()->route('admin.place.list');
    }

    /**
    * 場所削除
    * @param  Request $request
    * @param  Place   $place
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Place $place)
    {
        $place->delete();
        // 完了メッセージをセット
        session()->flash('message', '場所情報を削除しました。');
        return redirect()->route('admin.place.list');
    }
}
