<?php

namespace App\Enums\Event;

use ArchTech\Enums\Values;

enum Type: int
{
    use Values;

    // 0はif文判定でfalseとなるので1から使用
    case MENS_SINGLES   = 1;
    case MENS_DOUBLES   = 2;
    case WOMENS_SINGLES = 3;
    case WOMENS_DOUBLES = 4;
    case MIXED_DOUBLES  = 5;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::MENS_SINGLES   => '男子シングルス',
            self::MENS_DOUBLES   => '男子ダブルス',
            self::WOMENS_SINGLES => '女子シングルス',
            self::WOMENS_DOUBLES => '女子ダブルス',
            self::MIXED_DOUBLES  => 'ミックスダブルス',
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
            self::MENS_SINGLES   => '人',
            self::MENS_DOUBLES   => '組',
            self::WOMENS_SINGLES => '人',
            self::WOMENS_DOUBLES => '組',
            self::MIXED_DOUBLES  => '組',
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
            self::MENS_SINGLES   => '',
            self::MENS_DOUBLES   => '',
            self::WOMENS_SINGLES => '',
            self::WOMENS_DOUBLES => '',
            self::MIXED_DOUBLES  => '',
        };
    }
}
