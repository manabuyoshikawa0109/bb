<?php

namespace App\ModelItems\Event;

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
}
