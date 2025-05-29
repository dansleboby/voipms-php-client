<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\OnOffInteger;
use VoipMs\V2\Enum\CdrCallBilling;
use VoipMs\V2\Enum\RouteOption;
use VoipMs\V2\Enum\SmsMessageType;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'CDRs' (Call Detail Records) API methods.
 */
class Cdrs extends AbstractApi
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
     * Retrieves call accounts.
     *
     * @param int|null $clientId Optional. Client ID to filter accounts for.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallAccounts(?int $clientId = null): array
    {
        $params = [];
        if ($clientId !== null) {
            $params['client_id'] = $clientId;
        }
        return $this->get('getCallAccounts', $params);
    }

    /**
     * Retrieves call billing types.
     *
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallBilling(): array
    {
        return $this->get('getCallBilling');
    }

    /**
     * Retrieves call types.
     *
     * @param int|null $clientId Optional. Client ID to filter call types for.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallTypes(?int $clientId = null): array
    {
        $params = [];
        if ($clientId !== null) {
            $params['client_id'] = $clientId;
        }
        return $this->get('getCallTypes', $params);
    }

    /**
     * Retrieves Call Detail Records (CDRs) within a date range and optional filters.
     *
     * @param string $dateFrom Start date (YYYY-MM-DD).
     * @param string $dateTo End date (YYYY-MM-DD).
     * @param OnOffInteger|null $answered Filter by answered calls.
     * @param OnOffInteger|null $noAnswer Filter by unanswered calls.
     * @param OnOffInteger|null $busy Filter by busy calls.
     * @param OnOffInteger|null $failed Filter by failed calls.
     * @param string|null $timezone Timezone for the date range.
     * @param string|null $callType Filter by call type (e.g., 'outgoing', 'incoming', or a specific DID).
     * @param CdrCallBilling|null $callBilling Filter by call billing status.
     * @param string|null $account Filter by specific account.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCDR(
        string $dateFrom,
        string $dateTo,
        ?OnOffInteger $answered = null,
        ?OnOffInteger $noAnswer = null,
        ?OnOffInteger $busy = null,
        ?OnOffInteger $failed = null,
        ?string $timezone = null,
        ?string $callType = null, // Can be CdrCallType enum or a specific DID string
        ?CdrCallBilling $callBilling = null,
        ?string $account = null
    ): array {
        $params = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
        if ($answered !== null) $params['answered'] = $answered->value;
        if ($noAnswer !== null) $params['no_answer'] = $noAnswer->value;
        if ($busy !== null) $params['busy'] = $busy->value;
        if ($failed !== null) $params['failed'] = $failed->value;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($callType !== null) $params['call_type'] = $callType; // Pass string directly
        if ($callBilling !== null) $params['call_billing'] = $callBilling->value;
        if ($account !== null) $params['account'] = $account;

        return $this->get('getCDR', $params);
    }

    /**
     * Retrieves rates for a specific package and query.
     *
     * @param string $package The package name.
     * @param string $query The query string (e.g., a phone number prefix).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRates(string $package, string $query): array
    {
        $params = [
            'package' => $package,
            'query' => $query,
        ];
        return $this->get('getRates', $params);
    }

    /**
     * Retrieves termination rates for a specific route and query.
     *
     * @param RouteOption $route The route option.
     * @param string $query The query string (e.g., a phone number prefix).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getTerminationRates(RouteOption $route, string $query): array
    {
        $params = [
            'route' => $route->value,
            'query' => $query,
        ];
        return $this->get('getTerminationRates', $params);
    }

    /**
     * Retrieves Reseller Call Detail Records (CDRs) for a specific client.
     *
     * @param string $dateFrom Start date (YYYY-MM-DD).
     * @param string $dateTo End date (YYYY-MM-DD).
     * @param int $client The client ID.
     * @param OnOffInteger|null $answered Filter by answered calls.
     * @param OnOffInteger|null $noAnswer Filter by unanswered calls.
     * @param OnOffInteger|null $busy Filter by busy calls.
     * @param OnOffInteger|null $failed Filter by failed calls.
     * @param string|null $timezone Timezone for the date range.
     * @param string|null $callType Filter by call type (e.g., 'outgoing', 'incoming', or a specific DID).
     * @param CdrCallBilling|null $callBilling Filter by call billing status.
     * @param string|null $account Filter by specific account.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getResellerCDR(
        string $dateFrom,
        string $dateTo,
        int $client,
        ?OnOffInteger $answered = null,
        ?OnOffInteger $noAnswer = null,
        ?OnOffInteger $busy = null,
        ?OnOffInteger $failed = null,
        ?string $timezone = null,
        ?string $callType = null, // Can be CdrCallType enum or a specific DID string
        ?CdrCallBilling $callBilling = null,
        ?string $account = null
    ): array {
        $params = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'client' => $client,
        ];
        if ($answered !== null) $params['answered'] = $answered->value;
        if ($noAnswer !== null) $params['no_answer'] = $noAnswer->value;
        if ($busy !== null) $params['busy'] = $busy->value;
        if ($failed !== null) $params['failed'] = $failed->value;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($callType !== null) $params['call_type'] = $callType; // Pass string directly
        if ($callBilling !== null) $params['call_billing'] = $callBilling->value;
        if ($account !== null) $params['account'] = $account;

        return $this->get('getResellerCDR', $params);
    }

    /**
     * Retrieves Reseller SMS messages.
     *
     * @param int|null $smsId Optional. Specific SMS ID.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD). API defaults to today.
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD). API defaults to today.
     * @param int|null $clientId Optional. Client ID.
     * @param SmsMessageType|null $type Optional. Message type (received/sent).
     * @param string|null $did Optional. DID number.
     * @param string|null $contact Optional. Contact number.
     * @param int|null $limit Optional. Limit number of results.
     * @param string|null $timezone Optional. Timezone.
     * @param OnOffInteger|null $allMessages Optional. Get all messages (1 for all, 0 for only new).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getResellerSms(
        ?int $smsId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $clientId = null,
        ?SmsMessageType $type = null,
        ?string $did = null,
        ?string $contact = null,
        ?int $limit = null,
        ?string $timezone = null,
        ?OnOffInteger $allMessages = null
    ): array {
        $params = [];
        if ($smsId !== null) $params['sms'] = $smsId; // API param is 'sms'
        if ($dateFrom !== null) $params['from'] = $dateFrom; // API param is 'from'
        if ($dateTo !== null) $params['to'] = $dateTo; // API param is 'to'
        if ($clientId !== null) $params['client'] = $clientId; // API param is 'client'
        if ($type !== null) $params['type'] = $type->value;
        if ($did !== null) $params['did'] = $did;
        if ($contact !== null) $params['contact'] = $contact;
        if ($limit !== null) $params['limit'] = $limit;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($allMessages !== null) $params['all_messages'] = $allMessages->value;

        return $this->get('getResellerSms', $params);
    }

    /**
     * Retrieves Reseller MMS messages.
     *
     * @param int|null $mmsId Optional. Specific MMS ID.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD). API defaults to today.
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD). API defaults to today.
     * @param int|null $clientId Optional. Client ID.
     * @param SmsMessageType|null $type Optional. Message type (received/sent).
     * @param string|null $did Optional. DID number.
     * @param string|null $contact Optional. Contact number.
     * @param int|null $limit Optional. Limit number of results.
     * @param string|null $timezone Optional. Timezone.
     * @param OnOffInteger|null $allMessages Optional. Get all messages (1 for all, 0 for only new).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getResellerMms(
        ?int $mmsId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $clientId = null,
        ?SmsMessageType $type = null,
        ?string $did = null,
        ?string $contact = null,
        ?int $limit = null,
        ?string $timezone = null,
        ?OnOffInteger $allMessages = null
    ): array {
        $params = [];
        if ($mmsId !== null) $params['mms'] = $mmsId; // API param is 'mms'
        if ($dateFrom !== null) $params['from'] = $dateFrom; // API param is 'from'
        if ($dateTo !== null) $params['to'] = $dateTo; // API param is 'to'
        if ($clientId !== null) $params['client'] = $clientId; // API param is 'client'
        if ($type !== null) $params['type'] = $type->value;
        if ($did !== null) $params['did'] = $did;
        if ($contact !== null) $params['contact'] = $contact;
        if ($limit !== null) $params['limit'] = $limit;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($allMessages !== null) $params['all_messages'] = $allMessages->value;

        return $this->get('getResellerMms', $params);
    }
}
