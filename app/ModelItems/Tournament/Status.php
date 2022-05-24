<?php

namespace App\ModelItems\Tournament;

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
}
