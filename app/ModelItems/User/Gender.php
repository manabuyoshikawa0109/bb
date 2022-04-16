<?php

namespace App\ModelItems\User;

/**
 * 性別
 */
class Gender
{
    const MEN   = 0; // 男性
    const WOMEN = 1; // 女性

    public static $items = [
        self::MEN,
        self::WOMEN,
    ];
}
