<?php

declare(strict_types=1);

namespace App\Order\Repository\Api;

use App\Order\DTO\OrderDTO;
use App\Order\DTO\OrdersDTO;
use App\Order\DTO\ProductDTO;
use App\Order\DTO\ProductsDTO;

final readonly class OrdersDTOFactory
{
    public function __construct(private ResponseValidator $validator)
    {
    }

    /** @throws ValidationFailedException */
    public function create(array $apiResponse): OrdersDTO
    {
        $this->validator->validate($apiResponse);

        if (empty($apiResponse['orders'])) {
            OrdersDTO::empty();
        }

        $orders = [];
        foreach ($apiResponse['orders'] as $order) {

            $products = [];
            foreach ($order['products'] as $product) {
                $products[] = new ProductDTO((int)$product['product_id']);
            }

            $orders[] = new OrderDTO($order['order_id'], new ProductsDTO(...$products));
        }

        return new OrdersDTO(...$orders);
    }
}