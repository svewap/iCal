<?php

/*
 * This file is part of the eluceo/iCal package.
 *
 * (c) 2026 Markus Poerschke <markus@poerschke.nrw>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Eluceo\iCal\Domain\ValueObject;

use InvalidArgumentException;

final class TimeSpan extends Occurrence
{
    private DateTime $begin;
    private DateTime $end;

    public function __construct(DateTime $begin, DateTime $end)
    {
        if ($end->getDateTime() <= $begin->getDateTime()) {
            throw new InvalidArgumentException(sprintf(
                'TimeSpan end (%s) must be later than begin (%s) per RFC 5545 §3.8.2.2.',
                $end->getDateTime()->format(\DateTimeInterface::ATOM),
                $begin->getDateTime()->format(\DateTimeInterface::ATOM),
            ));
        }

        $this->begin = $begin;
        $this->end = $end;
    }

    public static function create(DateTime $begin, DateTime $end): self
    {
        return new static($begin, $end);
    }

    public function getBegin(): DateTime
    {
        return $this->begin;
    }

    public function getEnd(): DateTime
    {
        return $this->end;
    }
}
