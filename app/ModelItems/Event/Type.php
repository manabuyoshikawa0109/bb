<?php

namespace App\ModelItems\Event;

use Illuminate\Support\Arr;

/**
 * 種別
 */
class Type
{
    const SINGLES = 0; // シングルス
    const DOUBLES = 1; // ダブルス
    const MIX     = 2; // ミックス

    public static $items = [
        self::SINGLES => 'シングルス',
        self::DOUBLES => 'ダブルス',
        self::MIX     => 'ミックス',
    ];

    public static $units = [
        self::SINGLES => '人',
        self::DOUBLES => '組',
        self::MIX     => '組',
    ];

    public static $colorClasses = [
        self::SINGLES => 'primary',
        self::DOUBLES => 'success',
        self::MIX     => 'danger',
    ];

    /**
     * 種目名を返す
     *
     * @param int|null $typeId
     * @return string|null
     */
    public static function name(int $typeId = null)
    {
        if ($typeId === null) {
            return null;
        }
        return Arr::get(self::$items, $typeId);
    }

    /**
     * 種目毎の単位を返す
     *
     * @param int|null $typeId
     * @return string|null
     */
    public static function unit(int $typeId = null)
    {
        if ($typeId === null) {
            return null;
        }
        return Arr::get(self::$units, $typeId);
    }

    /**
     * 色に関するクラス名を返す
     *
     * @param int|null $typeId
     * @return string|null
     */
    public static function colorClass(int $typeId = null)
    {
        if ($typeId === null) {
            return null;
        }
        return Arr::get(self::$colorClasses, $typeId);
    }
}
