<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Storage;
use Image;

class FileHelper
{
    /**
    * ファイルを削除する
    *
    * @param string|null $path ファイルのパス
    * @return void
    */
    public static function delete(string $path = null)
    {
        $storage = Storage::disk('public');
        // パスがない、もしくはファイルが存在しない場合何もせず処理終了
        if (!$path || !$storage->exists($path)) {
            return;
        }
        $storage->delete($path);
    }


    /**
     * ファイルパスを取得する
     * ※ファイルパス生成ルールは「{サイト(フロント・管理)}/{モデルの複数形}/{モデルid}/{ファイル名}.{拡張子}」
     * ※ディレクトリごと削除できるようパスにidを含める(これによりモデルに関連する全ファイルの削除が可能)
     *
     * @param Model $model モデル
     * @param UploadedFile $file ファイルデータ
     * @param string $fileName ファイル名
     * @return string
     */
    public static function getPath(Model $model, UploadedFile $file, string $fileName = 'image')
    {
        $site = 'front';
        if (request()->routeIs('admin.*')) {
            $site = 'admin';
        }
        $extension = $file->getClientOriginalExtension();
        return "{$site}/{$model->getTable()}/{$model->id}/{$fileName}.{$extension}";
    }

    /**
     * 画像をリサイズする
     * ※将来的に縦横比を維持したままリサイズする等の処理を入れたい為共通化しておく
     *
     * @param UploadedFile $file ファイルデータ
     * @param integer $width リサイズしたい幅
     * @param integer $height リサイズしたい高さ
     * @return Image
     */
    public static function resizeImage(UploadedFile $file, int $width, int $height)
    {
        $image = Image::make($file)->orientate();
        $image->resize($width, $height);

        return $image;
    }
}
