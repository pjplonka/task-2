<?php

declare(strict_types=1);

namespace App\Order\DTO;

readonly class ProductsDTO
{
    /** @var ProductDTO[] */
    private array $products;

    public function __construct(ProductDTO ...$products)
    {
        $this->products = $products;
    }

    public static function empty(): self
    {
        return new self();
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}