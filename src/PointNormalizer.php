<?php

namespace Viny;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PointNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    /**
     * @param Point $object
     *
     * @return array{latitude:float,longitude:float}
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'latitude' => $object->getLatitude(),
            'longitude' => $object->getLongitude(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Point;
    }

    /**
     * @param array{latitude:float,longitude:float} $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): Point
    {
        return new Point($data['latitude'], $data['longitude']);
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return Point::class === $type;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
