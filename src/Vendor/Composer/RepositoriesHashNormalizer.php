<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2023 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/json-normalizer
 */

namespace Ergebnis\Json\Normalizer\Vendor\Composer;

use Ergebnis\Json\Json;
use Ergebnis\Json\Normalizer\Format;
use Ergebnis\Json\Normalizer\Normalizer;

final class RepositoriesHashNormalizer implements Normalizer
{
    use WildcardSortTrait;
    private const PROPERTIES_WITH_WILDCARDS = [
        /**
         * @see https://getcomposer.org/doc/articles/repository-priorities.md#filtering-packages
         */
        'exclude',
        'only',
    ];

    public function normalize(Json $json): Json
    {
        $decoded = $json->decoded();

        if (!\is_object($decoded)) {
            return $json;
        }

        if (!\property_exists($decoded, 'repositories')) {
            return $json;
        }

        if (!\is_object($decoded->repositories) && !\is_array($decoded->repositories)) {
            return $json;
        }

        /** @var array<string, mixed> $FIXME */
        $repositories = (array) $decoded->repositories;

        if ([] === $repositories) {
            return $json;
        }

        foreach ($repositories as &$repository) {
            $repository = (array) $repository;

            foreach (self::PROPERTIES_WITH_WILDCARDS as $property) {
                self::sortPropertyWithWildcard(
                    $repository,
                    $property,
                    false,
                );
            }
        }

        $decoded->repositories = $repositories;

        /** @var string $encoded */
        $encoded = \json_encode(
            $decoded,
            Format\JsonEncodeOptions::default()->toInt(),
        );

        return Json::fromString($encoded);
    }
}
