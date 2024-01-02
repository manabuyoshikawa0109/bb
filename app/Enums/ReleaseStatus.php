<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum ReleaseStatus: int
{
    use Values;

    case ALL                     = 0;
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
            self::ALL                    => 'すべて',
            self::HAS_NOT_RELEASED_YET   => '公開前',
            self::RELEASING              => '公開中',
            self::HAS_FINISHED_RELEASING => '公開終了',
        };
    }

    /**
    * 色に関するクラス名
    * @return string [description]
    */
    public function colorClass(): string
    {
        return match($this)
        {
            self::ALL                    => 'dark',
            self::HAS_NOT_RELEASED_YET   => 'info',
            self::RELEASING              => 'success',
            self::HAS_FINISHED_RELEASING => 'danger',
        };
    }

    /**
    * モデルのスコープ名
    * @return string [description]
    */
    public function scopeMethodName(): string
    {
        return match($this)
        {
            self::ALL                    => '',
            self::HAS_NOT_RELEASED_YET   => 'hasNotReleasedYet',
            self::RELEASING              => 'releasing',
            self::HAS_FINISHED_RELEASING => 'hasFinishedReleasing',
        };
    }
}
