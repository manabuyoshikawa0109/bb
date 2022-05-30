<?php

namespace App\ModelItems\Tournament;

use Illuminate\Support\Arr;

/**
 * 状態
 */
class Status
{
    const CLOSED = 0; // 非公開
    const OPEN   = 1; // 公開中

    public static $items = [
        self::CLOSED => '非公開',
        self::OPEN   => '公開中',
    ];

    /**
     * 状態名を返す
     *
     * @param int|null $statusId
     * @return string|null
     */
    public static function name(int $statusId = null)
    {
        if ($statusId === null) {
            return null;
        }
        return Arr::get(self::$items, $statusId);
    }
}
