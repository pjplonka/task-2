<?php

declare(strict_types=1);

namespace App\Order\Repository;

use App\Order\Repository\Filters\Source;

readonly class Filters
{
    public function __construct(private ?Source $source = null)
    {
    }

    public static function empty(): self
    {
        return new self();
    }

    public function toParameters(): array
    {
        $parameters = [];

        if ($this->source) {
            $parameters['filter_order_source'] = $this->source->value;
        }

        return $parameters;
    }
}