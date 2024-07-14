<?php

declare(strict_types=1);

namespace App\Order\Message;

use App\Order\Repository\Orders;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetOrdersHandler
{
    public function __construct(private Orders $orders)
    {
    }

    public function __invoke(GetOrders $getOrders)
    {
        $orders = $this->orders->get($getOrders->filters);

        // todo: store orders || send them || whatever
    }
}