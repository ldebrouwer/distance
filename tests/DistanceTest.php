<?php

use LucDeBrouwer\Distance\Distance;

/**
 * Class DistanceTest
 */
class DistanceTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test the setting and getting of the distance unit.
     */
    public function testUnit()
    {
        $distance = new Distance();
        $distance->setUnit('mi');

        $this->assertEquals('mi', $distance->getUnit());
    }

    /**
     * Test the throwing of an exception in case we try to set an invalid unit.
     *
     * @expectedException Exception
     */
    public function testInvalidUnit()
    {
        $distance = new Distance();

        $distance->setUnit('ft');
    }

    /**
     * Test the setting and getting of the distance formula.
     */
    public function testFormula()
    {
        $distance = new Distance();
        $distance->setFormula('vincenty');

        $this->assertEquals('vincenty', $distance->getFormula());
    }

    /**
     * Test the throwing of an exception in case we try to set an invalid formula.
     *
     * @expectedException Exception
     */
    public function testInvalidFormula()
    {
        $distance = new Distance();

        $distance->setFormula('Leonardo');
    }

    /**
     * Test the throwing of an exception in case an invalid parameter is being passed.
     *
     * @expectedException Exception
     */
    public function testInvalidParams()
    {
        $distance = new Distance();

        $distance->between('1', 1, 'not a float', 'invalid');
    }

    /**
     * Test the retrieval of the distance between the Apple and Google campuses.
     */
    public function testDistanceBetweenAppleAndGoogle()
    {
        $distance = new Distance();
        $distance->setUnit('m');
        $distance->setFormula('vincenty');

        $this->assertEquals(11164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('km');

        $this->assertEquals(11.164, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));

        $distance->setUnit('mi');

        $this->assertEquals(6.936987987488, $distance->between(37.331741, -122.030333, 37.422546, -122.084250));
    }
}