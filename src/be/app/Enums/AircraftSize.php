<?php

namespace App\Enums;

enum AircraftSize: string
{
    case NARROW_BODY = 'narrow_body';
    case WIDE_BODY = 'wide_body';
    case LIGHT_JET = 'light_jet';
    case HEAVZ_JET = 'heavy_jet';
}
