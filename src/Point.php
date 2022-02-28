<?php
declare(strict_types=1);

namespace Viny;

class Point
{
    protected float $latitude;
    protected float $longitude;

    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function __toString(): string
    {
        return sprintf('POINT(%f %f)', $this->latitude, $this->longitude);
    }
}
