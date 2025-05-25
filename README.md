# VoIP.ms PHP Client

[![Latest Stable Version](https://poser.pugx.org/dansleboby/voipms-php-client/v/stable)](https://packagist.org/packages/dansleboby/voipms-php-client)
[![License](https://poser.pugx.org/dansleboby/voipms-php-client/license)](https://packagist.org/packages/dansleboby/voipms-php-client)

A robust PHP client for the [VoIP.ms API](https://voip.ms/m/api.php), built on Guzzle with PSR-3 logging.

## Features

* Easy-to-use client for all VoIP.ms API methods.
* Built on the popular Guzzle HTTP client for reliable requests.
* PSR-3 compliant logging for easy integration with your existing logging setup.
* Handles API errors and network issues gracefully with custom exceptions.
* Includes retry logic for transient network errors.

## Requirements

* PHP >= 8.0
* [GuzzleHttp/Guzzle](https://packagist.org/packages/guzzlehttp/guzzle) ^7.0
* [PSR/Log](https://packagist.org/packages/psr/log) ^1.1|^2.0

## Installation

You can install the package via Composer:

```bash
composer require dansleboby/voipms-php-client
````

## Usage

First, you need to instantiate the `VoipMs\Client\Service\Client`. It requires a Guzzle client instance, a PSR-3 logger instance, your VoIP.ms API username, and your API password.

```php
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use Monolog\Logger; // Or any PSR-3 compliant logger
use Monolog\Handler\StreamHandler;
use VoipMs\Client\Service\Client;
use VoipMs\Client\Exception\ApiException;
use VoipMs\Client\Exception\HttpException;
use VoipMs\Client\Exception\JsonException;

// Create a Guzzle client
$guzzleClient = new GuzzleClient([
    'base_uri' => Client::BASE_URI, // Optional: Guzzle base URI
]);

// Create a logger (example using Monolog)
$logger = new Logger('voipms-client');
$logger->pushHandler(new StreamHandler('path/to/your/log/file.log', Logger::DEBUG));

// Your VoIP.ms API credentials
$apiUsername = 'your_api_username';
$apiPassword = 'your_api_password';

// Instantiate the VoIP.ms Client
$voipMsClient = new Client($guzzleClient, $logger, $apiUsername, $apiPassword);

// Example: Get account balance
try {
    $params = [
        // Add any specific parameters for the getBalance method if required by VoIP.ms
        // For example, if it needs a specific account: 'account' => '123456'
    ];
    $response = $voipMsClient->call('getBalance', $params); // Method name as per VoIP.ms API documentation

    // Successful API call
    print_r($response);

    // Expected response structure (example, refer to VoIP.ms documentation):
    // [
    //     'status' => 'success',
    //     'balance' => [
    //         'current_balance' => '123.45',
    //         // ... other balance details
    //     ]
    // ]

} catch (ApiException $e) {
    // Handle API-specific errors (e.g., invalid credentials, method not found)
    echo "API Error: " . $e->getMessage() . "\n";
    print_r($e->getResponseData()); // Contains the raw response data from the API
} catch (HttpException $e) {
    // Handle HTTP errors (e.g., 404, 500)
    echo "HTTP Error: " . $e->getMessage() . "\n";
    echo "Response Body: " . $e->getResponseBody() . "\n"; // Contains the raw HTTP response body
} catch (JsonException $e) {
    // Handle errors during JSON decoding of the API response
    echo "JSON Decode Error: " . $e->getMessage() . "\n";
    echo "Raw Response: " . $e->getRawResponse() . "\n"; // Contains the raw, undecodable response string
} catch (\Exception $e) {
    // Handle other general exceptions
    echo "An unexpected error occurred: " . $e->getMessage() . "\n";
}

?>
```

### Making API Calls

The primary method for interacting with the VoIP.ms API is `call(string $method, array $params = []): array`.

  * `$method`: The name of the API method you want to call (e.g., `getDIDsInfo`, `sendSMS`). Refer to the [official VoIP.ms API documentation](https://voip.ms/m/api.php) for a list of available methods and their required parameters.
  * `$params`: An associative array of parameters to send with the API request.

The client automatically adds your `api_username`, `api_password`, sets `content_type` to `json`, and includes the specified `$method` in the request.

### Configuration

The `Client` constructor accepts optional arguments for timeout and maximum retries:

  * `$timeout`: Request timeout in seconds (default: 30).
  * `$maxRetries`: Maximum number of retries for failed requests due to network issues (default: 3).

## Error Handling

The client uses the following custom exceptions:

  * `VoipMs\Client\Exception\ApiException`: Thrown when the VoIP.ms API returns an error status (e.g., "status" field in the response is not "success"). You can access the API's response data using `$e->getResponseData()`.
  * `VoipMs\Client\Exception\HttpException`: Thrown for HTTP-level errors (e.g., status codes other than 200). You can access the raw HTTP response body using `$e->getResponseBody()`.
  * `VoipMs\Client\Exception\JsonException`: Thrown if the API response cannot be decoded as JSON. You can access the raw, undecoded response string using `$e->getRawResponse()`.

Network errors leading to `GuzzleHttp\Exception\RequestException` or `GuzzleHttp\Exception\TransferException` are caught internally and retried up to `$maxRetries` times with an exponential backoff. If retries are exhausted, an `HttpException` is thrown.

## Development

This project uses [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) for coding standards and [PHPUnit](https://phpunit.de/) for testing. [GrumPHP](https://github.com/phpro/grumphp) is configured to run checks automatically on commit.

Available Composer scripts:

  * `composer cs:check`: Check for coding standards violations.
  * `composer cs:fix`: Automatically fix coding standards violations.
  * `composer test`: Run coding standards checks and PHPUnit tests.

The PHPCS standard is defined in `phpcs.xml.dist`. GrumPHP tasks are configured in `grumphp.yml`.

### Autoloading

  * PSR-4 autoloading for application code: `VoipMs\Client\Service\` maps to `src/Service/` and `VoipMs\Client\Exception\` maps to `src/Exception/`.
  * PSR-4 autoloading for development (tests): `App\Tests\` maps to `tests/`.

## Author

  * Gilbert Paquin [gpaquin@gp.run](mailto:gpaquin@gp.run)

## License

This project is licensed under the MIT License. See the [LICENSE](https://www.google.com/search?q=LICENSE) file for details (You would need to create this file, but the `composer.json` specifies "MIT").

