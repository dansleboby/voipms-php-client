<?php

namespace VoipMs\V2\Exception;

class JsonException extends \Exception
{
    private $responseBody;

    public function __construct($message = "", $responseBody = "", \Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->responseBody = $responseBody;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }
}
