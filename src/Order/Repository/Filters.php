<?php

declare(strict_types=1);

namespace App\Order\Repository;

readonly class Filters
{
    public static function empty(): self
    {
        return new self();
    }

    public function toParameters(): array
    {
        // todo

        return [];
    }
}