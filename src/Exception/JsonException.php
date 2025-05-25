<?php

declare(strict_types=1);

namespace VoipMs\Client\Exception;

class JsonException extends \RuntimeException
{
    private string $rawResponse;

    public function __construct(
        string $message,
        ?string $rawResponse = '',
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
        $this->rawResponse = $rawResponse;
    }

    public function getRawResponse(): string
    {
        return $this->rawResponse;
    }
}
