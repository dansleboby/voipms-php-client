<?php

declare(strict_types=1);

namespace VoipMs\Client\Exception;

class ApiException extends \RuntimeException
{
    private array $responseData;

    public function __construct(
        string $message,
        int $code = 0,
        ?array $responseData = null,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->responseData = $responseData ?? [];
    }

    public function getResponseData(): array
    {
        return $this->responseData;
    }
}
