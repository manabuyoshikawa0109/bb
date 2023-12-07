<?php

use Illuminate\Support\Facades\File;

if (!function_exists('disableCacheWhenModified')) {
    /**
    * ファイルパスの末尾にファイルの更新日時を付与して返す
    * ※ファイル更新時にキャッシュが効かないように
    * @param string $path HTML上で設定するファイルの相対パス (public配下) ※先頭スラッシュ必須
    * @return string
    */
    function disableCacheWhenModified(string $path)
    {
        $timestamp = File::lastModified(public_path() . $path);
        return "{$path}?{$timestamp}";
    }
}

if (!function_exists('dotFieldName')) {
    /**
     * 配列形式のフィールド名をドット区切りに変換する
     *
     * @param string $fieldName フィールド名
     * @return string
     */
    function dotFieldName(string $fieldName)
    {
        $fieldName = str_replace('[', '.', $fieldName);
        $fieldName = str_replace(']', '', $fieldName);

        return $fieldName;
    }
}
