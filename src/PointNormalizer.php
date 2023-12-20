<?php
declare(strict_types=1);

namespace Viny;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PointNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param Point $object
     * @param string|null $format
     * @param array $context
     *
     * @return array{latitude:float,longitude:float}
     */
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return [
            'latitude' => $object->getLatitude(),
            'longitude' => $object->getLongitude(),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Point;
    }

    /**
     * @param array{latitude:float,longitude:float} $data
     * @param string $type
     * @param string|null $format
     * @param array $context
     *
     * @return Point
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Point
    {
        return new Point($data['latitude'], $data['longitude']);
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return Point::class === $type;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Point::class => true,
        ];
    }
}
