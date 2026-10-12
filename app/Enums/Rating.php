<?php

namespace App\Enums;

enum Rating: string
{
    case N = 'N';
    case P = 'P';
    case L = 'L';
    case F = 'F';

    public function score(): float
    {
        return (float) config('audit.rating_scores.'.$this->value);
    }
}
