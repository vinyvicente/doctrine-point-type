<?php
declare(strict_types=1);

namespace Viny;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use function sprintf;
use function strtoupper;

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
     * @param array $column
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return strtoupper(self::POINT);
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

        if ($value instanceof Point) {
            return $value;
        }

        list($latitude, $longitude) = sscanf($value, 'POINT(%f %f)');

        return new Point($latitude, $longitude);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
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
        return sprintf('ST_AsText(%s)', $value);
    }

    /**
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform): string
    {
        return sprintf('ST_PointFromText(%s)', $sqlExpr);
    }
}
