<?php

namespace App\Enums\Tournament;

use ArchTech\Enums\Values;

enum Status: int
{
    use Values;

    case CLOSED = 0;
    case OPEN   = 1;

    /**
    * 名称
    * @return string [description]
    */
    public function name(): string
    {
        return match($this)
        {
            self::CLOSED => '非公開',
            self::OPEN   => '公開中',
        };
    }

    /**
    * 非公開か
    * @return boolean
    */
    public function isClosed(): bool
    {
        return $this === self::CLOSED;
    }

    /**
    * 公開中か
    * @return boolean
    */
    public function isOpen(): bool
    {
        return $this === self::OPEN;
    }
}
