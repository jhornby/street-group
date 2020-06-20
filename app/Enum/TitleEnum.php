<?php

declare(strict_types=1);

namespace App\Enum;

class TitleEnum
{
    public static function getAll(): array
    {
        return [
            'Dr',
            'Mr',
            'Ms',
            'Mrs',
            'Miss',
            'Mister',
            'Prof',
        ];
    }
}
