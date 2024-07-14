<?php

declare(strict_types=1);

namespace App\Tests\Order\Integration;

use App\Order\Repository\Api\BaseLinkerApiOrders;
use App\Order\Repository\Filters;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BaseLinkerApiOrdersTest extends KernelTestCase
{
    /** @test */
    public function happyPath(): void
    {
        // Before
        self::bootKernel();

        [$mockResponse, $httpClient] = $this->prepareHttpClientMock();

        $container = static::getContainer();
        $container->set(HttpClientInterface::class, $httpClient);

        /** @var BaseLinkerApiOrders $orders */
        $orders = $container->get(BaseLinkerApiOrders::class);

        // When
        $ordersDTO = $orders->get(Filters::empty());

        // Then

        // Assert OrdersDTO
        $this->assertCount(1, $ordersDTO->getOrders());
        $this->assertSame(1630473, $ordersDTO->getOrders()[0]->getId());
        $this->assertCount(1, $ordersDTO->getOrders()[0]->getProducts());
        $this->assertSame(5434, $ordersDTO->getOrders()[0]->getProducts()[0]->getId());

        // Assert Http Client request
        $this->assertSame('POST', $mockResponse->getRequestMethod());
        $this->assertSame('https://api.com/', $mockResponse->getRequestUrl());
        $this->assertSame('X-BLToken: base_linker_api_token_test', $mockResponse->getRequestOptions()['headers'][0]);
        $this->assertSame('method=getOrders', $mockResponse->getRequestOptions()['body']);
    }

    /** @return array{MockResponse, MockHttpClient} */
    private function prepareHttpClientMock(): array
    {
        $expectedResponseJson = file_get_contents(__DIR__ . '/../files/get_orders_success_response.json');;
        $mockResponse = new MockResponse($expectedResponseJson, [
            'http_code' => 200,
            'response_headers' => ['Content-Type: application/json'],
        ]);

        $httpClient = new MockHttpClient($mockResponse, 'https://example.com');

        return [$mockResponse, $httpClient];
    }
}