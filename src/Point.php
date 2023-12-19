<?php
declare(strict_types=1);

namespace Viny;

use Stringable;

readonly class Point implements Stringable
{
    public function __construct(private float $latitude, private float $longitude)
    {
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
