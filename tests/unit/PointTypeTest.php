<?php

namespace Viny\Tests;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;
use Viny\PointType;

/**
 * Class PointTypeTest
 *
 * @package Viny\Tests
 */
class PointTypeTest extends TestCase
{
    protected PointType $type;
    protected AbstractPlatform $platform;

    public function setUp(): void
    {
        Type::addType('point', 'Viny\\PointType');

        $this->platform = $this->getMockForAbstractClass(AbstractPlatform::class, [], '', true, true);

        $this->type = Type::getType('point');
    }

    public function testConvertToPHPValue(): void
    {
        $point = $this->type->convertToPHPValue('POINT(-22.00444 -13.33444)', $this->platform);

        $this->assertInstanceOf("Viny\\Point", $point);
        $this->assertInstanceOf("Doctrine\\DBAL\\Types\\Type", $this->type);
        $this->assertEquals(-13.33444, $point->getLongitude());
        $this->assertEquals(-22.00444, $point->getLatitude());
        $this->assertTrue($this->type->canRequireSQLConversion(), "Point type require SQL conversion to work.");
        $this->assertEquals('ST_PointFromText(POINT(-22.004440 -13.334440))', $this->type->convertToDatabaseValueSQL($point, $this->platform));
        $this->assertEquals('ST_AsText(POINT(-22.004440 -13.334440))', $this->type->convertToPHPValueSQL($point, $this->platform));
        $this->assertEquals(PointType::POINT, $this->type->getName());
        $this->assertEquals(strtoupper(PointType::POINT), $this->type->getSQLDeclaration([], $this->platform));
        $this->assertEquals('POINT(-22.004440 -13.334440)', $this->type->convertToDatabaseValue($point, $this->platform));
        $this->assertInstanceOf('Viny\\Point', $this->type->convertToPHPValue($point, $this->platform));
        $this->assertNull($this->type->convertToPHPValue(null, $this->platform));
    }
}
