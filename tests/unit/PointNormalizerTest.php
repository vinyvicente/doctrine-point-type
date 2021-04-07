<?php
declare(strict_types=1);

namespace Viny\Tests;

use PHPUnit\Framework\TestCase;
use Viny\Point;
use Viny\PointNormalizer;

/**
 * Class PointNormalizerTest
 *
 * @package Viny\Tests
 */
class PointNormalizerTest extends TestCase
{
    /** @var PointNormalizer */
    private $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new PointNormalizer();
    }

    public function testNormalize(): void
    {
        $this->assertSame(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            $this->normalizer->normalize(new Point(-22.00444, -13.33444))
        );
    }

    public function testSupportsNormalization(): void
    {
        $this->assertFalse($this->normalizer->supportsNormalization(1));
        $this->assertTrue($this->normalizer->supportsNormalization(new Point(-22.00444, -13.33444)));
        $this->assertTrue($this->normalizer->hasCacheableSupportsMethod());
    }

    public function testDenormalize(): void
    {
        $this->assertEquals(
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
        $this->assertFalse($this->normalizer->supportsDenormalization(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            'int'
        ));
        $this->assertTrue($this->normalizer->supportsDenormalization(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            Point::class
        ));
    }
}
