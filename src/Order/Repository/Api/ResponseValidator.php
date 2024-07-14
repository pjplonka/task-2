<?php

declare(strict_types=1);

namespace App\Order\Repository\Api;

/**
 * TODO: use Symfony Validator and return ConstraintViolationListInterface
 */
final readonly class ResponseValidator
{
    /** @throws ValidationFailedException */
    public function validate(array $response): void
    {
        if (!$response['orders']) {
            return;
        }

        if (!is_array($response['orders'])) {
            throw new ValidationFailedException('Order must be an array.');
        }

        foreach ($response['orders'] as $order) {
            $this->validateOrder($order);
        }
    }

    /** @throws ValidationFailedException */
    private function validateOrder($order): void
    {
        if (!is_array($order)) {
            throw new ValidationFailedException('Order must be an array.');
        }

        if (empty($order['order_id'])) {
            throw new ValidationFailedException('Order must contain `order_id` field.');
        }

        if (!is_array($order['products'])) {
            throw new ValidationFailedException(
                sprintf('Products must be an array. Order id: %s.', $order['order_id'])
            );
        }

        if (!$order['products']) {
            return;
        }

        foreach ($order['products'] as $product) {
            $this->validateProduct($product, (string)$order['order_id']);
        }
    }

    /** @throws ValidationFailedException */
    private function validateProduct($product, string $orderId): void
    {
        if (!is_array($product)) {
            throw new ValidationFailedException(
                sprintf('Product must be an array. Order id: %s.', $orderId)
            );
        }

        if (empty($product['product_id'])) {
            throw new ValidationFailedException(
                sprintf('Product must contain `product_id` field. Order id: %s.', $orderId)
            );
        }
    }
}