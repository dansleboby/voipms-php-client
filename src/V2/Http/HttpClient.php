<?php

namespace VoipMs\V2\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Psr\Log\LoggerInterface;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

class HttpClient
{
    private $guzzleClient;
    private $logger;
    private $timeout;
    private $maxRetries;

    public function __construct(
        ClientInterface $guzzleClient,
        LoggerInterface $logger,
        int $timeout = 30,
        int $maxRetries = 3
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->logger = $logger;
        $this->timeout = $timeout;
        $this->maxRetries = $maxRetries;
    }

    public function request(string $httpMethod, string $uri, array $options = []): array
    {
        $this->logger->info("API Request: {$httpMethod} {$uri}", ['options' => $this->sanitizeOptions($options)]);

        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                $response = $this->guzzleClient->request($httpMethod, $uri, array_merge($options, ['timeout' => $this->timeout]));

                $statusCode = $response->getStatusCode();
                $responseBody = (string) $response->getBody();

                if ($statusCode !== 200) {
                    $this->logger->error("API Error: HTTP {$statusCode}", ['uri' => $uri, 'responseBody' => $responseBody]);
                    throw new HttpException("HTTP Error {$statusCode}", $statusCode, $responseBody);
                }

                $decodedBody = json_decode($responseBody, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->logger->error("API Error: Failed to decode JSON response", ['uri' => $uri, 'responseBody' => $responseBody]);
                    throw new JsonException("Failed to decode JSON response: " . json_last_error_msg(), $responseBody);
                }

                $this->logger->info("API Success: {$httpMethod} {$uri}", ['statusCode' => $statusCode]);
                return $decodedBody;

            } catch (RequestException $e) {
                $this->logger->warning("API Request Failed (RequestException): Attempt {$attempt}/{$this->maxRetries} for {$httpMethod} {$uri}", ['exception' => $e->getMessage()]);
                if ($attempt >= $this->maxRetries) {
                    throw new HttpException("API request failed after {$this->maxRetries} retries (RequestException): " . $e->getMessage(), $e->getCode(), '', $e);
                }
                sleep(1 << ($attempt -1)); // Exponential backoff: 1, 2, 4 seconds
            } catch (TransferException $e) {
                $this->logger->warning("API Request Failed (TransferException): Attempt {$attempt}/{$this->maxRetries} for {$httpMethod} {$uri}", ['exception' => $e->getMessage()]);
                if ($attempt >= $this->maxRetries) {
                    throw new HttpException("API request failed after {$this->maxRetries} retries (TransferException): " . $e->getMessage(), $e->getCode(), '', $e);
                }
                sleep(1 << ($attempt-1)); // Exponential backoff: 1, 2, 4 seconds
            }
        }

        // If the loop finishes without returning or throwing a specific exception from the catch blocks
        $this->logger->error("API Request Failed: Max retries reached for {$httpMethod} {$uri}");
        throw new HttpException("API request failed after {$this->maxRetries} retries.", 0, "Max retries reached");
    }

    private function sanitizeOptions(array $options): array
    {
        // Remove sensitive data like 'auth' before logging
        unset($options['auth']);
        // Potentially remove other sensitive keys if they exist in your options
        // unset($options['headers']['Authorization']); // If you pass auth tokens this way
        return $options;
    }
}
