<?php

namespace VoipMs\V2\Exception;

class HttpException extends \Exception
{
    private $statusCode;
    private $responseBody;

    public function __construct($message = "", $statusCode = 0, $responseBody = "", \Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }
}
