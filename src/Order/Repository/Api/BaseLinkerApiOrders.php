<?php

declare(strict_types=1);

namespace App\Order\Repository\Api;

use App\BaseLinkerSDK\HttpClient;
use App\Order\DTO\OrdersDTO;
use App\Order\Repository\Filters;
use App\Order\Repository\Orders;

final readonly class BaseLinkerApiOrders implements Orders
{
    private const API_METHOD = 'getOrders';

    public function __construct(
        private HttpClient $client,
        private OrdersDTOFactory $factory
    ) {
    }

    /** @throws ValidationFailedException */
    public function get(Filters $filters): OrdersDTO
    {
        $response = $this->client->post(self::API_METHOD, $filters->toParameters());

        if (empty($response['orders'])) {
            return OrdersDTO::empty();
        }

        return $this->factory->create($response);
    }
}