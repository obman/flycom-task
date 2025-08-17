<?php

namespace App\Enums;

enum ReservationType: string
{
    case RANGE = 'range';
    case MULTIPLE = 'multiple';
}