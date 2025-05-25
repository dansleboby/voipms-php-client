<?php

declare(strict_types=1);

namespace VoipMs\Client\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use VoipMs\Client\Exception\ApiException;
use VoipMs\Client\Exception\HttpException;
use VoipMs\Client\Exception\JsonException;

class Client
{
    public const ENDPOINT = 'https://voip.ms/api/v1/rest.php';
    public const BASE_URI = 'https://voip.ms/api/v1/';

    private ClientInterface $http;
    private LoggerInterface $logger;
    private string $username;
    private string $password;
    private int $timeout;
    private int $maxRetries;

    public function __construct(
        ClientInterface $http,
        LoggerInterface $logger,
        string $username,
        string $password,
        int $timeout = 30,
        int $maxRetries = 3
    ) {
        $this->http = $http;
        $this->logger = $logger;
        $this->username = $username;
        $this->password = $password;
        $this->timeout = $timeout;
        $this->maxRetries = $maxRetries;
    }

    public function call(string $method, array $params = []): array
    {
        $query = array_merge(
            [
                'api_username' => $this->username,
                'api_password' => $this->password,
                'method'       => $method,
                'content_type' => 'json',
            ],
            $params
        );

        $uri = self::ENDPOINT . '?' . http_build_query($query);
        $this->logger->info('VoIP.ms API request', ['method' => $method, 'query' => $params]);

        return $this->executeWithRetry($uri, $method);
    }

    private function executeWithRetry(string $uri, string $method): array
    {
        $attempt = 0;
        do {
            try {
                $response = $this->http->request('GET', $uri, [
                    'timeout' => $this->timeout,
                ]);

                $status = $response->getStatusCode();
                $body   = (string) $response->getBody();

                if ($status !== 200) {
                    $this->logger->error('Unexpected HTTP status', ['status' => $status]);
                    throw new HttpException("HTTP $status error", $status, $body);
                }

                $data = \json_decode($body, true, 512, JSON_THROW_ON_ERROR);

                if (($data['status'] ?? '') !== 'success') {
                    $error = $data['error'] ?? json_encode($data);
                    $this->logger->error('API returned error', ['error' => $error]);
                    throw new ApiException("API error: $error", 0, $data);
                }

                $this->logger->info('API call successful', ['method' => $method]);
                return $data;
            } catch (RequestException | TransferException $e) {
                $attempt++;
                $this->logger->warning('Network error, retrying', ['attempt' => $attempt, 'exception' => $e]);
                if ($attempt > $this->maxRetries) {
                    throw new HttpException('Exceeded retry limit', 0, $e->getMessage(), $e);
                }
                sleep(1 << $attempt);
            } catch (\JsonException $e) {
                $this->logger->error('Failed to decode JSON', ['exception' => $e]);
                throw new JsonException('Invalid JSON response', $body, $e);
            }
        } while ($attempt <= $this->maxRetries);

        throw new ApiException('Unexpected failure after retries');
    }
}
