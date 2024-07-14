<?php

declare(strict_types=1);

namespace App\Order\DTO;

readonly class ProductDTO
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}