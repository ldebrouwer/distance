<?php

declare(strict_types=1);

namespace Tests\LucDeBrouwer\Distance;

use LucDeBrouwer\Distance\Distance;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DistanceTest extends TestCase
{
    #[Test]
    public function canSetUnit(): void
    {
        $distance = new Distance();
        $distance->setUnit('mi');

        $this->assertSame('mi', $distance->getUnit());
    }

    #[Test]
    public function willThrowExceptionInCaseWeSetAnInvalidUnit(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('You have tried to set an invalid distance unit.');

        $distance = new Distance();

        $distance->setUnit('mm');
    }

    #[Test]
    public function canSetFormula(): void
    {
        $distance = new Distance();
        $distance->setFormula('vincenty');

        $this->assertSame('vincenty', $distance->getFormula());
    }

    #[Test]
    public function willThrowExceptionInCaseWeSetAnInvalidFormula(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('You have tried to set an invalid distance formula.');

        $distance = new Distance();

        $distance->setFormula('Leonardo');
    }

    #[Test]
    public function canConvertDistanceUsingVincentyFormula(): void
    {
        $distance = new Distance();
        $distance->setUnit('m');
        $distance->setFormula('vincenty');

        $this->assertSame(11164.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('km');

        $this->assertSame(11.164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('mi');

        $this->assertSame(6.936987987488, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('cm');

        $this->assertSame(1116400.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('ft');

        $this->assertSame(36627.2966436, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('in');

        $this->assertSame(439527.5586068, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));
    }

    #[Test]
    public function canConvertDistanceUsingHaversineFormula(): void
    {
        $distance = new Distance();
        $distance->setUnit('m');
        $distance->setFormula('haversine');

        $this->assertSame(11164.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('km');

        $this->assertSame(11.164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('mi');

        $this->assertSame(6.936987987488, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('cm');

        $this->assertSame(1116400.0, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('ft');

        $this->assertSame(36627.2966436, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('in');

        $this->assertSame(439527.5586068, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));
    }
}
