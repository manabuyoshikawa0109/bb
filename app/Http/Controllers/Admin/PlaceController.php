<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SavePlaceRequest;
use Illuminate\Http\UploadedFile;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Models\Place;
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
        DB::beginTransaction();
        try {
            $place = new Place();
            $place->fill($request->validated())->save();

            // 新規登録時はまだid値がわからず画像パスを生成できない為、2回保存処理を行う
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
            // 画像削除フラグが立っている場合、既存画像を削除
            if ($request->delete_image) {
                FileHelper::delete($place->image_path);
                $place->image_path = null;
            }

            // 画像変更時拡張子が異なり直近の画像がサーバーに残ってしまう可能性がある為、直近にアップロードされた画像を削除
            if ($file = $request->file) {
                FileHelper::delete($place->image_path);
                $path = $this->_uploadImage($file, $place);
                $place->image_path = $path;
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
            // 画像を削除
            FileHelper::delete($place->image_path);
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
        // 画像アップロード先のパスを取得
        $path = FileHelper::getPath($place, $file);

        // 画像をリサイズ
        // ※現状縦横比を維持しない
        $dimensions = config('admin.place.image.dimensions');
        $image = FileHelper::resizeImage($file, $dimensions['width'], $dimensions['height']);

        // 画像アップロード先のパスに画像ファイルを保存
        Storage::disk('public')->put($path, (string)$image->encode());

        return $path;
    }
}
