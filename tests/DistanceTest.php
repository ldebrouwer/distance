<?php

declare(strict_types=1);

namespace Tests\ldebrouwer\Distance;

use ldebrouwer\Distance\Distance;
use ldebrouwer\Distance\Formula;
use ldebrouwer\Distance\Unit;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    private const float LATITUDE_A = 37.331741;
    private const float LONGITUDE_A = -122.030333;
    private const float LATITUDE_B = 37.422546;
    private const float LONGITUDE_B = -122.084250;

    #[Test]
    public function canSetUnit(): void
    {
        $distance = new Distance();
        $distance->setUnit(Unit::MILES);

        self::assertSame(Unit::MILES, $distance->getUnit());
    }

    #[Test]
    public function canSetFormula(): void
    {
        $distance = new Distance();
        $distance->setFormula(Formula::VINCENTY);

        self::assertSame(Formula::VINCENTY, $distance->getFormula());
    }

    #[Test]
    #[TestWith([Unit::METRES, 11164.0])]
    #[TestWith([Unit::KILOMETRES, 11.164])]
    #[TestWith([Unit::MILES, 6.936987987488])]
    #[TestWith([Unit::CENTIMETRES, 1116400.0])]
    #[TestWith([Unit::FEET, 36627.2966436])]
    #[TestWith([Unit::INCHES, 439527.5586068])]
    public function canConvertDistanceUsingVincentyFormula(Unit $unit, float $expected): void
    {
        $distance = new Distance();
        $distance->setFormula(Formula::VINCENTY);

        self::assertSame($expected, $distance->setUnit($unit)->between(self::LATITUDE_A, self::LONGITUDE_A, self::LATITUDE_B, self::LONGITUDE_B));
    }

    #[Test]
    #[TestWith([Unit::METRES, 11164.0])]
    #[TestWith([Unit::KILOMETRES, 11.164])]
    #[TestWith([Unit::MILES, 6.936987987488])]
    #[TestWith([Unit::CENTIMETRES, 1116400.0])]
    #[TestWith([Unit::FEET, 36627.2966436])]
    #[TestWith([Unit::INCHES, 439527.5586068])]
    public function canConvertDistanceUsingHaversineFormula(Unit $unit, float $expected): void
    {
        $distance = new Distance();
        $distance->setFormula(Formula::HAVERSINE);

        self::assertSame($expected, $distance->setUnit($unit)->between(self::LATITUDE_A, self::LONGITUDE_A, self::LATITUDE_B, self::LONGITUDE_B));
    }
}
