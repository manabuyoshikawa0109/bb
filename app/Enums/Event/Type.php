<?php

namespace App\Enums\Event;

use ArchTech\Enums\Values;

enum Type: int
{
    use Values;

    case SINGLES       = 1;
    case DOUBLES       = 2;
    case MIXED_DOUBLES = 3;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::SINGLES       => 'シングルス',
            self::DOUBLES       => 'ダブルス',
            self::MIXED_DOUBLES => 'ミックスダブルス',
        };
    }

    /**
    * 単位
    * @return string [description]
    */
    public function unit(): string
    {
        return match($this)
        {
            self::SINGLES       => '人',
            self::DOUBLES       => '組',
            self::MIXED_DOUBLES => '組',
        };
    }

    /**
    * Bootstrapの色クラス
    * @return string [description]
    */
    public function colorClass(): string
    {
        return match($this)
        {
            self::SINGLES       => 'primary',
            self::DOUBLES       => 'danger',
            self::MIXED_DOUBLES => 'success',
        };
    }
}
