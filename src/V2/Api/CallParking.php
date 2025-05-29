<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\Language;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'CallParking' API methods.
 */
class CallParking extends AbstractApi
{
    /**
     * @param HttpClient $httpClient The HTTP client for making API requests.
     * @param string $apiUsername The Voip.ms API username.
     * @param string $apiPassword The Voip.ms API password.
     */
    public function __construct(HttpClient $httpClient, string $apiUsername, string $apiPassword)
    {
        parent::__construct($httpClient, $apiUsername, $apiPassword);
    }

    /**
     * Retrieves Call Parking configurations.
     *
     * @param int|null $callParkingId Optional. The specific Call Parking ID to retrieve.
     *                                If null, all Call Parking configurations are retrieved.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallParking(?int $callParkingId = null): array
    {
        $params = [];
        if ($callParkingId !== null) {
            $params['callparking'] = $callParkingId;
        }
        return $this->get('getCallParking', $params);
    }

    /**
     * Sets (creates or updates) a Call Parking configuration.
     *
     * @param string $name Name of the Call Parking lot.
     * @param int $timeout Timeout in seconds.
     * @param string $music Music on Hold name/ID.
     * @param string $failover Failover routing string (e.g., "account:123456").
     * @param Language $language Language for announcements.
     * @param string $destination Destination routing string if timeout occurs.
     * @param int $delay Delay in seconds before returning call.
     * @param int $blfLamps Number of BLF lamps to generate.
     * @param int|null $callParkingId Optional. If provided, updates the existing Call Parking with this ID.
     *                                  Otherwise, creates a new Call Parking.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setCallParking(
        string $name,
        int $timeout,
        string $music,
        string $failover,
        Language $language,
        string $destination,
        int $delay,
        int $blfLamps,
        ?int $callParkingId = null
    ): array {
        $params = [
            'name' => $name,
            'timeout' => $timeout,
            'music' => $music,
            'failover' => $failover,
            'language' => $language->value,
            'destination' => $destination,
            'delay' => $delay,
            'blf_lamps' => $blfLamps,
        ];

        if ($callParkingId !== null) {
            $params['callparking'] = $callParkingId;
        }

        return $this->post('setCallParking', $params);
    }

    /**
     * Deletes a Call Parking configuration.
     *
     * @param int $callParkingId The ID of the Call Parking configuration to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delCallParking(int $callParkingId): array
    {
        $params = ['callparking' => $callParkingId];
        return $this->post('delCallParking', $params);
    }
}
