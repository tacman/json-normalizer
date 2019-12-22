<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/json-normalizer
 */

namespace Ergebnis\Json\Normalizer\Test\Util\DataProvider;

final class Text
{
    /**
     * @return \Generator<array<string>>
     */
    public function provideWhitespace(): \Generator
    {
        $values = [
            '',
            ' ',
            "\t",
            \PHP_EOL,
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }
}
