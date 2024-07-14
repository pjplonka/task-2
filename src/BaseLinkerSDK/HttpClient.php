<?php

declare(strict_types=1);

namespace App\BaseLinkerSDK;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class HttpClient
{
    public function __construct(
        private HttpClientInterface $client,
        private string $baseLinkerApiUrl,
        private string $baseLinkerApiToken,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function post(string $method, array $parameters): array
    {
        // todo: handle errors in response and throws exception

        return $this->client->request('POST', $this->baseLinkerApiUrl, [
            'headers' => [
                'X-BLToken' => $this->baseLinkerApiToken,
            ],
            'body' => ['method' => $method, 'parameters' => $parameters],
        ])->toArray();
    }
}