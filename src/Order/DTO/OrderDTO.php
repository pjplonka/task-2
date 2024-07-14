<?php

declare(strict_types=1);

namespace App\Order\DTO;

readonly class OrderDTO
{
    public function __construct(private int $id, private ProductsDTO $productsDTO)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    /** @return ProductDTO[] */
    public function getProducts(): array
    {
        return $this->productsDTO->getProducts();
    }
}