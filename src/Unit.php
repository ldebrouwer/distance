<?php

declare(strict_types=1);

namespace LucDeBrouwer\Distance;

enum Unit: string
{
    case CENTIMETRES = 'cm';
    case INCHES = 'in';
    case FEET = 'ft';
    case METRES = 'm';
    case KILOMETRES = 'km';
    case MILES = 'mi';

    public function multiplierFromMetres(): int|float
    {
        return match ($this) {
            self::CENTIMETRES => 100,
            self::INCHES => 39.3700787,
            self::FEET => 3.2808399,
            self::METRES => 1,
            self::KILOMETRES => 0.001,
            self::MILES => 0.000621371192,
        };
    }
}
