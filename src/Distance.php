<?php

declare(strict_types=1);

namespace LucDeBrouwer\Distance;

use RuntimeException;

/**
 * Distance helps you calculate the distance between GPS coordinates, in vanilla PHP. Pure and simple.
 */
class Distance
{
    /**
     * The formula used for distance calculation.
     */
    private string $formula = 'vincenty';

    /**
     * The unit used to return the distance in. The supported units are shown in the conversion table below.
     */
    private string $unit = 'km';

    /**
     * An array holding the conversion table from meters to several other units.
     *
     * @var array<string, int|float>
     */
    private array $conversion = [
        'cm' => 100, // centimeters
        'in' => 39.3700787, // inches
        'ft' => 3.2808399, // feet
        'm' => 1, // meters
        'km' => 0.001, // kilometers
        'mi' => 0.000621371192, // miles
    ];

    /**
     * Method that returns the distance between two GPS locations in the preferred unit according to the set formula.
     */
    public function between(float $latitudeA, float $longitudeA, float $latitudeB, float $longitudeB): float
    {
        $distanceInMeters = match ($this->getFormula()) {
            'vincenty' => $this->betweenVincenty($latitudeA, $longitudeA, $latitudeB, $longitudeB),
            'haversine' => $this->betweenHaversine($latitudeA, $longitudeA, $latitudeB, $longitudeB),
            default => throw new RuntimeException('Invalid formula'),
        };

        return $this->convert($distanceInMeters);
    }

    /**
     * Method that returns the distance between two GPS locations in meters according to the Vincenty formula.
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
     * Method that returns the distance between two GPS locations in meters according to the Haversine formula.
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
        return $distance * $this->conversion[$this->getUnit()];
    }

    /**
     * Returns the currently set formula used for distance calculation.
     */
    public function getFormula(): string
    {
        return $this->formula;
    }

    /**
     * Sets the formula to be used for distance calculation.
     *
     * @throws RuntimeException
     */
    public function setFormula(string $formula): void
    {
        if (!in_array($formula, ['vincenty', 'haversine'], true)) {
            throw new RuntimeException('You have tried to set an invalid distance formula.');
        }

        $this->formula = $formula;
    }

    /**
     * Returns the currently set unit used when returning the distance between two coordinates.
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Sets the unit to be used when returning the distance between two coordinates.
     *
     * @throws RuntimeException
     */
    public function setUnit(string $unit): void
    {
        if (!array_key_exists($unit, $this->conversion)) {
            throw new RuntimeException('You have tried to set an invalid distance unit.');
        }

        $this->unit = $unit;
    }
}
