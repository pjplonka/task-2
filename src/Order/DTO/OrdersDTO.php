<?php

declare(strict_types=1);

namespace App\Order\DTO;

readonly class OrdersDTO
{
    /** @var OrderDTO[] */
    private array $orders;

    public function __construct(OrderDTO ...$orders)
    {
        $this->orders = $orders;
    }

    public static function empty(): self
    {
        return new self();
    }

    public function getOrders(): array
    {
        return $this->orders;
    }
}