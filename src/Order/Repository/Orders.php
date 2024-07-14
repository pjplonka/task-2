<?php

declare(strict_types=1);

namespace App\Order\Repository;

use App\Order\DTO\OrdersDTO;

interface Orders
{
    public function get(Filters $filters): OrdersDTO;
}