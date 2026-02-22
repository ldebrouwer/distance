<?php

declare(strict_types=1);

namespace LucDeBrouwer\Distance;

enum Formula: string
{
    case VINCENTY = 'vincenty';
    case HAVERSINE = 'haversine';
}
