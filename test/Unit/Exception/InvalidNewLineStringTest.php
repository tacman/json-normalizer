<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2022 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/json-normalizer
 */

namespace Ergebnis\Json\Normalizer\Test\Unit\Exception;

use Ergebnis\Json\Normalizer\Exception;

/**
 * @internal
 *
 * @covers \Ergebnis\Json\Normalizer\Exception\InvalidNewLineString
 */
final class InvalidNewLineStringTest extends AbstractExceptionTestCase
{
    public function testDefaults(): void
    {
        $exception = new Exception\InvalidNewLineString();

        self::assertSame('', $exception->string());
    }

    public function testFromSizeAndMinimumSizeReturnsInvalidIndentStringException(): void
    {
        $string = self::faker()->word();

        $exception = Exception\InvalidNewLineString::fromString($string);

        $message = \sprintf(
            '"%s" is not a valid new-line character sequence.',
            $string,
        );

        self::assertSame($message, $exception->getMessage());
        self::assertSame($string, $exception->string());
    }
}