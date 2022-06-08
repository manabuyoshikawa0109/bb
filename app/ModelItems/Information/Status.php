<?php

namespace App\ModelItems\Information;

use Illuminate\Support\Arr;

/**
 * 状態
 */
class Status
{
    const BEFORE_RELEASE = '公開前';
    const RELEASING      = '公開中';
    const RELEASE_END    = '公開終了';

    public static $scopes = [
        self::BEFORE_RELEASE => 'beforeRelease',
        self::RELEASING      => 'releasing',
        self::RELEASE_END    => 'releaseEnd',
    ];

    public static $colorClasses = [
        self::BEFORE_RELEASE => 'primary',
        self::RELEASING      => 'success',
        self::RELEASE_END    => 'danger',
    ];

    /**
     * 色に関するクラス名を返す
     *
     * @param string|null $statusName
     * @return string|null
     */
    public static function colorClass(string $statusName = null)
    {
        if ($statusName === null) {
            return null;
        }
        return Arr::get(self::$colorClasses, $statusName);
    }
}
