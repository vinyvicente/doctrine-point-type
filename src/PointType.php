<?php

namespace Viny;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class PointType
 * @package Uello\Types
 */
class PointType extends Type
{
    const POINT = 'point';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::POINT;
    }

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'POINT';
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Point
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Point
    {
        if (empty($value)) {
            return null;
        }

        list($latitude, $longitude) = sscanf($value, 'POINT(%f %f)');

        return new Point($latitude, $longitude);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof Point) {
            $value = sprintf('POINT(%F %F)', $value->getLatitude(), $value->getLongitude());
        }

        return $value;
    }

    /**
     * @return bool
     */
    public function canRequireSQLConversion(): bool
    {
        return true;
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToPHPValueSQL($value, $platform): string
    {
        return sprintf('AsText(%s)', $value);
    }

    /**
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform): string
    {
        return sprintf('PointFromText(%s)', $sqlExpr);
    }
}
