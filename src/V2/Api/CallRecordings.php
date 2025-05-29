<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;
// No specific Enums are listed for direct use in method parameters here,
// but CdrCallType could be relevant for callType values.
// For now, sticking to string as per method signature.

/**
 * Handles 'CallRecordings' API methods.
 */
class CallRecordings extends AbstractApi
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
     * Retrieves call recordings for a specific account within a date range.
     *
     * @param string $account The account/sub-account username.
     * @param string $dateFrom Start date (YYYY-MM-DD).
     * @param string $dateTo End date (YYYY-MM-DD).
     * @param int|null $start Optional. Start offset for pagination.
     * @param int|null $length Optional. Number of records to retrieve for pagination.
     * @param string|null $callType Optional. Filter by call type ('all', 'incoming', 'outgoing').
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallRecordings(
        string $account,
        string $dateFrom,
        string $dateTo,
        ?int $start = null,
        ?int $length = null,
        ?string $callType = null
    ): array {
        $params = [
            'account' => $account,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($length !== null) {
            $params['length'] = $length;
        }
        if ($callType !== null) {
            $params['call_type'] = $callType;
        }
        return $this->get('getCallRecordings', $params);
    }

    /**
     * Retrieves a specific call recording.
     *
     * @param string $account The account/sub-account username.
     * @param string $callRecording The ID of the call recording.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallRecording(string $account, string $callRecording): array
    {
        $params = [
            'account' => $account,
            'callrecording' => $callRecording,
        ];
        return $this->get('getCallRecording', $params);
    }

    /**
     * Sends a call recording to an email address.
     *
     * @param string $account The account/sub-account username.
     * @param string $email The email address to send the recording to.
     * @param string $callRecording The ID of the call recording.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function sendCallRecordingEmail(string $account, string $email, string $callRecording): array
    {
        $params = [
            'account' => $account,
            'email' => $email,
            'callrecording' => $callRecording,
        ];
        return $this->post('sendCallRecordingEmail', $params);
    }

    /**
     * Deletes a specific call recording.
     *
     * @param string $account The account/sub-account username.
     * @param string $callRecording The ID of the call recording to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delCallRecording(string $account, string $callRecording): array
    {
        $params = [
            'account' => $account,
            'callrecording' => $callRecording,
        ];
        return $this->post('delCallRecording', $params);
    }
}
