<?php

declare(strict_types=1);

namespace Tests\LucDeBrouwer\Distance;

use LucDeBrouwer\Distance\Distance;
use LucDeBrouwer\Distance\Formula;
use LucDeBrouwer\Distance\Unit;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    #[Test]
    public function canSetUnit(): void
    {
        $distance = new Distance();
        $distance->setUnit(Unit::MILES);

        $this->assertSame(Unit::MILES, $distance->getUnit());
    }

    #[Test]
    public function canSetFormula(): void
    {
        $distance = new Distance();
        $distance->setFormula(Formula::VINCENTY);

        $this->assertSame(Formula::VINCENTY, $distance->getFormula());
    }

    #[Test]
    public function canConvertDistanceUsingVincentyFormula(): void
    {
        $distance = new Distance();
        $distance->setUnit(Unit::METRES);
        $distance->setFormula(Formula::VINCENTY);

        $this->assertSame(11164.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::KILOMETRES);

        $this->assertSame(11.164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::MILES);

        $this->assertSame(6.936987987488, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::CENTIMETRES);

        $this->assertSame(1116400.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::FEET);

        $this->assertSame(36627.2966436, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::INCHES);

        $this->assertSame(439527.5586068, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));
    }

    #[Test]
    public function canConvertDistanceUsingHaversineFormula(): void
    {
        $distance = new Distance();
        $distance->setUnit(Unit::METRES);
        $distance->setFormula(Formula::HAVERSINE);

        $this->assertSame(11164.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::KILOMETRES);

        $this->assertSame(11.164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::MILES);

        $this->assertSame(6.936987987488, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::CENTIMETRES);

        $this->assertSame(1116400.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::FEET);

        $this->assertSame(36627.2966436, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit(Unit::INCHES);

        $this->assertSame(439527.5586068, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));
    }
}
