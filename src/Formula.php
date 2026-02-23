<?php

declare(strict_types=1);

namespace ldebrouwer\Distance;

enum Formula: string
{
    case VINCENTY = 'vincenty';
    case HAVERSINE = 'haversine';
}
