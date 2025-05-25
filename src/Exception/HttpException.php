<?php

declare(strict_types=1);

namespace VoipMs\Client\Exception;

class HttpException extends \RuntimeException
{
    private string $responseBody;

    public function __construct(
        string $message,
        int $code,
        string $responseBody = '',
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->responseBody = $responseBody;
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }
}
