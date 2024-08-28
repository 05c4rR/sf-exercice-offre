<?php

namespace App\Serializer\Normalizer;

use App\Entity\Offer;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OfferNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer,
        private UrlGeneratorInterface $router
    ) {
    }

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        if (!$object instanceof Offer) {
            return $data;
        }

        $data['url'] = $this->router->generate(
            'offer_detail',
            ['id' => $data['id']],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Offer && array_search('location_read', $context['groups']) === false;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Offer::class => true];
    }
}
