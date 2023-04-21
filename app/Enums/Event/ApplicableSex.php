<?php

namespace App\Enums\Event;

use ArchTech\Enums\Values;

enum ApplicableSex: int
{
    use Values;

    case MALE   = 1;
    case FEMALE = 2;
    case BOTH   = 3;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::MALE   => '男性',
            self::FEMALE => '女性',
            self::BOTH   => '両方',
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
            self::MALE   => 'info',
            self::FEMALE => 'danger',
            self::BOTH   => 'success',
        };
    }
}
