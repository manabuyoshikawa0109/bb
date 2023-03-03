<?php

namespace App\Enums\User;

use ArchTech\Enums\Values;

enum Sex: int
{
    use Values;

    case MALE   = 1;
    case FEMALE = 2;

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
        };
    }
}
