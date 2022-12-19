<?php
declare(strict_types=1);

namespace Viny\Tests;

use PHPUnit\Framework\TestCase;
use Viny\Point;
use Viny\PointNormalizer;

class PointNormalizerTest extends TestCase
{
    private PointNormalizer $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new PointNormalizer();
    }

    public function testNormalize(): void
    {
        self::assertSame(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            $this->normalizer->normalize(new Point(-22.00444, -13.33444))
        );
    }

    public function testSupportsNormalization(): void
    {
        self::assertFalse($this->normalizer->supportsNormalization(1));
        self::assertTrue($this->normalizer->supportsNormalization(new Point(-22.00444, -13.33444)));
        self::assertTrue($this->normalizer->hasCacheableSupportsMethod());
    }

    public function testDenormalize(): void
    {
        self::assertEquals(
            new Point(-22.00444, -13.33444),
            $this->normalizer->denormalize(
                [
                    'latitude' => -22.00444,
                    'longitude' => -13.33444
                ],
                Point::class
            )
        );
    }

    public function testSupportsDenormalization(): void
    {
        self::assertFalse($this->normalizer->supportsDenormalization(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            'int'
        ));
        self::assertTrue($this->normalizer->supportsDenormalization(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            Point::class
        ));
    }
}
