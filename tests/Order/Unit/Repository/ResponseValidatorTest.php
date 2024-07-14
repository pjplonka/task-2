<?php

declare(strict_types=1);

namespace App\Tests\Order\Unit\Repository;

use App\Order\Repository\Api\ResponseValidator;
use App\Order\Repository\Api\ValidationFailedException;
use PHPUnit\Framework\TestCase;

class ResponseValidatorTest extends TestCase
{
    private ResponseValidator $validator;

    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function validResponse(): void
    {
        $response = file_get_contents(__DIR__ . '/../../files/get_orders_success_response.json');

        $this->validator->validate(json_decode($response, true));
    }

    /**
     * @test
     * @dataProvider provider
     */
    public function throws_exception(array $apiResponse, string $exceptionMessage): void
    {
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $this->validator->validate($apiResponse);
    }

    /** @return array<string, array{apiResponse: array, exceptionMessage: string}> */
    public function provider(): array
    {
        return [
            'orders_key_is_not_array' => [
                'apiResponse' => ['orders' => 1],
                'exceptionMessage' => 'Order must be an array.'
            ],
            'missing_order_id' => [
                'apiResponse' => [
                    'orders' => [
                        ['source' => 'ebay']
                    ]
                ],
                'exceptionMessage' => 'Order must contain `order_id` field.'
            ],
            'products_is_not_an_array' => [
                'apiResponse' => [
                    'orders' => [
                        ['order_id' => '123', 'products' => 1]
                    ]
                ],
                'exceptionMessage' => 'Products must be an array. Order id: 123.'
            ],
            'missing_product_id' => [
                'apiResponse' => [
                    'orders' => [
                        [
                            'order_id' => '123',
                            'products' => [
                                ['color' => 'red']
                            ]
                        ]
                    ]
                ],
                'exceptionMessage' => 'Product must contain `product_id` field. Order id: 123.'
            ],
        ];
    }

    protected function setUp(): void
    {
        $this->validator = new ResponseValidator();
    }
}