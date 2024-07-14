<?php

declare(strict_types=1);

namespace App\Order\Message;

use App\Order\Repository\Filters;

readonly class GetOrders
{
    public function __construct(public Filters $filters)
    {
    }
}