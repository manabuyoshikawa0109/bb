<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SavePlaceRequest;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Http\UploadedFile;
use Storage;
use Image;
use Throwable;
use Log;
use DB;

class PlaceController extends Controller
{
    /**
    * 場所一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        // 更新日時の降順でソート
        $places = Place::orderByDesc('updated_at')->get();
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

        DB::beginTransaction();
        try {
            if ($file = $request->file) {
                $path = $this->_uploadImage($file, $place);
                $place->image_path = $path;
                $place->save();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }

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
        DB::beginTransaction();
        try {
            if ($file = $request->file) {
                $path = $this->_uploadImage($file, $place);
                $place->image_path = $path;
            } elseif ($request->path == null) {
                $this->_deleteImage($place->image_path);
                $place->image_path = null;
            }

            // 画像変更時拡張子が異なる可能性がある為、直近にアップロードされた画像を削除
            if ($place->isDirty('image_path')) {
                $this->_deleteImage($place->getOriginal('image_path'));
            }
            $place->fill($request->validated())->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }
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
        DB::beginTransaction();
        try {
            Storage::disk('public')->deleteDirectory("admin/places/{$place->id}");
            $place->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }
        // 完了メッセージをセット
        session()->flash('message', '場所情報を削除しました。');
        return redirect()->route('admin.place.list');
    }

    /**
     * 画像アップロード
     *
     * @param UploadedFile $file
     * @param Place $place
     * @return string
     */
    private function _uploadImage(UploadedFile $file, Place $place)
    {
        $extension = $file->getClientOriginalExtension();
        // id指定でディレクトリ毎削除できるようなパスにする
        $path = "admin/places/{$place->id}/image.{$extension}";

        $image = Image::make($file)->orientate();
        $image->resize(config('admin.place.image.dimensions.width'), config('admin.place.image.dimensions.height'));
        Storage::disk('public')->put($path, (string)$image->encode());

        return $path;
    }

    /**
     * 画像を削除
     *
     * @param string|null $path
     * @return void
     */
    private function _deleteImage(string $path = null)
    {
        $storage = Storage::disk('public');
        // $path変数がnullだとexistsメソッドでエラーとなる
        if ($path && $storage->exists($path)){
            $storage->delete($path);
        }
    }
}
