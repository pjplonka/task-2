<?php

declare(strict_types=1);

namespace App\Order\Repository\Dbal;

use App\Order\Repository\Filters;
use App\Order\Repository\Orders;
use App\Order\DTO\OrdersDTO;

final readonly class DbalOrders implements Orders
{
    public function get(Filters $filters): OrdersDTO
    {
        // todo: load orders from db, map it to OrdersDTO and return

        return OrdersDTO::empty();
    }
}