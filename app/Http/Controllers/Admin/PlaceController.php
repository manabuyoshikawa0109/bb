<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterPlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Place;

class PlaceController extends Controller
{
    /**
     * 場所入力
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function input(Request $request)
    {
        if(old('places')){
            $newId = min(array_keys(old('places'))) -1;
            $places = collect();
            foreach (old('places') as $id => $input) {
               $place = new Place($input);
               $place->id = $id;
               $places->push($place);
            }
        }else{
            $newId = -1;
            $places = Place::all();
        }
        $placeInstance = new Place();
        return view('admin.pages.place.input', compact('places', 'placeInstance', 'newId'));
    }

    /**
     * 場所登録
     * @param  RegisterPlaceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterPlaceRequest $request)
    {
        $inputs = Arr::get($request->validated(), 'places');
        foreach ($inputs as $id => $input) {
            $place = Place::firstOrNew(['id' => $id]);
            if(isset($input['delete']) && $input['delete'] === '1'){
                $place->delete();
                continue;
            }
            $place->fill($input)->save();
        }
        // 完了メッセージをセット
        session()->flash('message', '場所情報を保存しました。');
        return redirect()->route('admin.place.input');
    }
}
