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

namespace Ergebnis\Json\Normalizer\Test\Unit\Exception;

use Ergebnis\Json\Normalizer\Exception;

/**
 * @internal
 *
 * @covers \Ergebnis\Json\Normalizer\Exception\OriginalInvalidAccordingToSchema
 */
final class OriginalInvalidAccordingToSchemaTest extends AbstractExceptionTestCase
{
    public function testDefaults(): void
    {
        $exception = new Exception\OriginalInvalidAccordingToSchema();

        self::assertSame([], $exception->errors());
        self::assertSame('', $exception->schemaUri());
    }

    public function testFromSchemaUriAndErrorsReturnsOriginalInvalidAccordingToSchemaException(): void
    {
        $faker = self::faker();

        $schemaUri = $faker->url();

        $errors = [
            $faker->sentence(),
            $faker->sentence(),
            $faker->sentence(),
        ];

        $exception = Exception\OriginalInvalidAccordingToSchema::fromSchemaUriAndErrors(
            $schemaUri,
            ...$errors,
        );

        $message = \sprintf(
            'Original JSON is not valid according to schema "%s".',
            $schemaUri,
        );

        self::assertSame($message, $exception->getMessage());
        self::assertSame($schemaUri, $exception->schemaUri());
        self::assertSame($errors, $exception->errors());
    }
}
