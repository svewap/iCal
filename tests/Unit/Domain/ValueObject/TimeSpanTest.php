<?php

/*
 * This file is part of the eluceo/iCal package.
 *
 * (c) 2026 Markus Poerschke <markus@poerschke.nrw>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Eluceo\iCal\Unit\Domain\ValueObject;

use DateTimeImmutable;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TimeSpanTest extends TestCase
{
    public function testValidTimeSpan(): void
    {
        $begin = new DateTime(new DateTimeImmutable('2026-09-21T22:00:00Z'), false);
        $end = new DateTime(new DateTimeImmutable('2026-09-23T22:00:00Z'), false);

        $timeSpan = new TimeSpan($begin, $end);

        self::assertSame($begin, $timeSpan->getBegin());
        self::assertSame($end, $timeSpan->getEnd());
    }

    public function testEndEqualsBeginIsRejected(): void
    {
        $instant = new DateTime(new DateTimeImmutable('2026-09-21T22:00:00Z'), false);

        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('must be later than begin');

        new TimeSpan($instant, $instant);
    }

    public function testEndBeforeBeginIsRejected(): void
    {
        $begin = new DateTime(new DateTimeImmutable('2026-09-23T22:00:00Z'), false);
        $end = new DateTime(new DateTimeImmutable('2026-09-21T22:00:00Z'), false);

        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('must be later than begin');

        new TimeSpan($begin, $end);
    }
}