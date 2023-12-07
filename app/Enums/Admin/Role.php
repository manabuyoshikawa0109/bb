<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum Role: int
{
    use Values;

    case ADMIN     = 1;
    case DEVELOPER = 2;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::ADMIN     => '管理者',
            self::DEVELOPER => '開発者',
        };
    }
}
