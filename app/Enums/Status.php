<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum Status: int
{
    use Values;

    case HAS_NOT_RELEASED_YET    = 1;
    case RELEASING               = 2;
    case HAS_FINISHED_RELEASING  = 3;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::HAS_NOT_RELEASED_YET   => '公開前',
            self::RELEASING              => '公開中',
            self::HAS_FINISHED_RELEASING => '公開終了',
        };
    }
}
