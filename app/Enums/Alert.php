<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum Alert: string
{
    use Values;

    case SUCCESS = 'success';
    case INFO    = 'info';
    case WARNING = 'warning';
    case ERROR   = 'error';
    case DEFAULT = 'default';

    /**
    * アイコンクラス
    * @return string [description]
    */
    public function iconClass(): string
    {
        return match($this)
        {
            self::SUCCESS => 'bx bx-check-circle',
            self::INFO    => 'bx bx-info-circle',
            self::WARNING => 'bx bx-error',
            self::ERROR   => 'bx bx-x-circle',
            self::DEFAULT => '',
        };
    }
}
