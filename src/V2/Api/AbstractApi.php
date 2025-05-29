<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;

/**
 * Abstract base class for API method categories.
 */
abstract class AbstractApi
{
    /**
     * @param HttpClient $httpClient The HTTP client for making API requests.
     * @param string $apiUsername The Voip.ms API username.
     * @param string $apiPassword The Voip.ms API password.
     */
    public function __construct(
        protected HttpClient $httpClient,
        protected string $apiUsername,
        protected string $apiPassword
    ) {
    }

    /**
     * Builds the parameters array for an API request.
     *
     * @param string $methodName The name of the API method to call.
     * @param array $specificParams Specific parameters for the API method.
     * @return array The options array for HttpClient->request (typically for GET requests).
     */
    protected function buildParams(string $methodName, array $specificParams = []): array
    {
        $baseParams = [
            'api_username' => $this->apiUsername,
            'api_password' => $this->apiPassword,
            'method' => $methodName,
            'content_type' => 'json', // Assuming JSON is always desired as per common practice
        ];

        $allParams = array_merge($baseParams, $specificParams);

        // For Voip.ms API, all parameters are typically sent as query parameters in a GET request.
        // If POST is used, this would need to be adjusted to use 'form_params'.
        return ['query' => $allParams];
    }

    /**
     * Performs a GET request to the API.
     *
     * @param string $methodName The API method name.
     * @param array $params Specific parameters for this API call.
     * @return array The decoded JSON response.
     * @throws \VoipMs\V2\Exception\HttpException if the API request fails.
     * @throws \VoipMs\V2\Exception\JsonException if the API response cannot be decoded.
     */
    protected function get(string $methodName, array $params = []): array
    {
        // The Voip.ms API uses a single endpoint, typically 'https://voip.ms/api/v2/rest.php'
        // This base URI should ideally be configured in the HttpClient or a general configuration.
        // For now, we assume the HttpClient is pre-configured with the base URI or it's passed in $uri.
        // Since the task description for HttpClient didn't specify a base URI,
        // we will assume HttpClient handles the full URI construction or is configured with it.
        // The $uri parameter in HttpClient->request is the path/endpoint.
        // Let's assume 'rest.php' is the endpoint for all calls for now.
        $options = $this->buildParams($methodName, $params);
        return $this->httpClient->request('GET', 'rest.php', $options);
    }

    /**
     * Performs a POST request to the API.
     *
     * @param string $methodName The API method name.
     * @param array $params Specific parameters for this API call, to be sent as form data.
     * @return array The decoded JSON response.
     * @throws \VoipMs\V2\Exception\HttpException if the API request fails.
     * @throws \VoipMs\V2\Exception\JsonException if the API response cannot be decoded.
     */
    protected function post(string $methodName, array $params = []): array
    {
        $baseParams = [
            'api_username' => $this->apiUsername,
            'api_password' => $this->apiPassword,
            'method' => $methodName,
            'content_type' => 'json',
        ];

        $formParams = array_merge($baseParams, $params);

        $options = ['form_params' => $formParams];
        // Assuming 'rest.php' is the endpoint for POST calls as well.
        return $this->httpClient->request('POST', 'rest.php', $options);
    }
}
