<?php

declare(strict_types=1);

namespace ldebrouwer\Distance;

/**
 * Distance helps you calculate the distance between GPS coordinates, in vanilla PHP. Pure and simple.
 */
class Distance
{
    /**
     * The formula used for distance calculation.
     */
    private Formula $formula = Formula::VINCENTY;

    /**
     * The unit used to return the distance in.
     */
    private Unit $unit = Unit::KILOMETRES;

    /**
     * Returns the distance between two GPS locations in the preferred unit according to the set formula.
     */
    public function between(float $latitudeA, float $longitudeA, float $latitudeB, float $longitudeB): float
    {
        $distanceInMeters = match ($this->getFormula()) {
            Formula::VINCENTY => $this->betweenVincenty($latitudeA, $longitudeA, $latitudeB, $longitudeB),
            Formula::HAVERSINE => $this->betweenHaversine($latitudeA, $longitudeA, $latitudeB, $longitudeB),
        };

        return $this->convert($distanceInMeters);
    }

    /**
     * Returns the distance between two GPS locations in meters according to the Vincenty formula.
     */
    private function betweenVincenty(float $latitudeA, float $longitudeA, float $latitudeB, float $longitudeB): float
    {
        $latitudeA = deg2rad($latitudeA);
        $longitudeA = deg2rad($longitudeA);
        $latitudeB = deg2rad($latitudeB);
        $longitudeB = deg2rad($longitudeB);
        $longDelta = $longitudeB - $longitudeA;
        $a = ((cos($latitudeB) * sin($longDelta)) ** 2) + ((cos($latitudeA) * sin($latitudeB) - sin($latitudeA) * cos($latitudeB) * cos($longDelta)) ** 2);
        $b = sin($latitudeA) * sin($latitudeB) + cos($latitudeA) * cos($latitudeB) * cos($longDelta);
        $angle = atan2(sqrt($a), $b);

        return floor($angle * 6371000);
    }

    /**
     * Returns the distance between two GPS locations in meters according to the Haversine formula.
     */
    private function betweenHaversine(float $latitudeA, float $longitudeA, float $latitudeB, float $longitudeB): float
    {
        $latitudeA = deg2rad($latitudeA);
        $longitudeA = deg2rad($longitudeA);
        $latitudeB = deg2rad($latitudeB);
        $longitudeB = deg2rad($longitudeB);
        $latDelta = $latitudeB - $latitudeA;
        $longDelta = $longitudeB - $longitudeA;
        $angle = 2 * asin(sqrt((sin($latDelta / 2) ** 2) + cos($latitudeA) * cos($latitudeB) * (sin($longDelta / 2) ** 2)));

        return floor($angle * 6371000);
    }

    private function convert(float $distance): float
    {
        return $distance * $this->unit->multiplierFromMetres();
    }

    /**
     * Returns the currently set formula used for distance calculation.
     */
    public function getFormula(): Formula
    {
        return $this->formula;
    }

    /**
     * Sets the formula to be used for distance calculation.
     */
    public function setFormula(Formula $formula): self
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Returns the currently set unit used when returning the distance between two coordinates.
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * Sets the unit to be used when returning the distance between two coordinates.
     */
    public function setUnit(Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}
