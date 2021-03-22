<?php


require __DIR__ . '/../bootstrap.php';

/**
 * Class PointNormalizer
 */
class PointNormalizerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \Viny\PointNormalizer */
    private $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new \Viny\PointNormalizer();
    }

    public function testNormalize(): void
    {
        $this->assertSame(
            [
                'latitude' => -22.00444,
                'longitude' => -13.33444
            ],
            $this->normalizer->normalize(new \Viny\Point(-22.00444, -13.33444))
        );
    }

    public function testSupportsNormalization(): void
    {
        $this->assertFalse($this->normalizer->supportsNormalization(1));
        $this->assertTrue($this->normalizer->supportsNormalization(new \Viny\Point(-22.00444, -13.33444)));
    }

    public function testDenormalize(): void
    {
        $this->assertEquals(
            new \Viny\Point(-22.00444, -13.33444),
            $this->normalizer->denormalize(
                [
                    'latitude' => -22.00444,
                    'longitude' => -13.33444
                ],
                \Viny\Point::class
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
        \Viny\Point::class
        ));
    }
}
