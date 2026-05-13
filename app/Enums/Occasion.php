<?php

namespace App\Enums;

enum Occasion: string
{
    case Casual = 'Casual';
    case Festa = 'Festa';
    case Trabalho = 'Trabalho';
    case Especial = 'Especial';

    public function label(): string
    {
        return $this->value;
    }
}
