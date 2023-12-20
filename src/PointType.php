<?php
declare(strict_types=1);

namespace Viny;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use function sprintf;
use function strtoupper;

class PointType extends Type
{
    public const POINT = 'point';

    public function getName(): string
    {
        return self::POINT;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return strtoupper(self::POINT);
    }

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

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value instanceof Point) {
            $value = sprintf('POINT(%F %F)', $value->getLatitude(), $value->getLongitude());
        }

        return $value;
    }

    public function canRequireSQLConversion(): bool
    {
        return true;
    }

    public function convertToPHPValueSQL($value, $platform): string
    {
        return sprintf('ST_AsText(%s)', $value);
    }

    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform): string
    {
        return sprintf('ST_PointFromText(%s)', $sqlExpr);
    }
}
