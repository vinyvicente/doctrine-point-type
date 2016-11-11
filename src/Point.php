<?php

namespace Viny;

/**
 * Class Point
 * @package Uello\ValueObject
 */
class Point
{
    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('POINT(%f %f)', $this->latitude, $this->longitude);
    }
}
