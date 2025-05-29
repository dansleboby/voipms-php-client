<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\Language;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'General' API methods.
 */
class General extends AbstractApi
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
     * Retrieves the current account balance.
     *
     * @param bool $advanced Set to true for detailed call statistics.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getBalance(bool $advanced = false): array
    {
        $params = [];
        if ($advanced) {
            $params['advanced'] = 'true'; // API typically expects string 'true' or 'false'
        }
        return $this->get('getBalance', $params);
    }

    /**
     * Retrieves information about a specific conference or all conferences.
     *
     * @param int|null $conference Optional. The specific conference ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getConference(?int $conference = null): array
    {
        $params = [];
        if ($conference !== null) {
            $params['conference'] = $conference;
        }
        return $this->get('getConference', $params);
    }

    /**
     * Retrieves members of a specific conference or all conference members.
     *
     * @param int|null $member Optional. The specific member ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getConferenceMembers(?int $member = null): array
    {
        $params = [];
        if ($member !== null) {
            $params['member'] = $member;
        }
        return $this->get('getConferenceMembers', $params);
    }

    /**
     * Retrieves recordings for a specific conference within a date range.
     *
     * @param int $conference The conference ID.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD).
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getConferenceRecordings(int $conference, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $params = ['conference' => $conference];
        if ($dateFrom !== null) {
            $params['date_from'] = $dateFrom;
        }
        if ($dateTo !== null) {
            $params['date_to'] = $dateTo;
        }
        return $this->get('getConferenceRecordings', $params);
    }

    /**
     * Retrieves a specific conference recording file.
     *
     * @param int $conference The conference ID.
     * @param int $recording The recording ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getConferenceRecordingFile(int $conference, int $recording): array
    {
        $params = [
            'conference' => $conference,
            'recording' => $recording,
        ];
        return $this->get('getConferenceRecordingFile', $params);
    }

    /**
     * Retrieves information about sequences.
     *
     * @param int|null $sequence Optional. The specific sequence ID.
     * @param int|null $client Optional. The client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getSequences(?int $sequence = null, ?int $client = null): array
    {
        $params = [];
        if ($sequence !== null) {
            $params['sequence'] = $sequence;
        }
        if ($client !== null) {
            $params['client'] = $client;
        }
        return $this->get('getSequences', $params);
    }

    /**
     * Retrieves information about countries.
     *
     * @param string|null $country Optional. The specific country code (e.g., 'US', 'CA').
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCountries(?string $country = null): array
    {
        $params = [];
        if ($country !== null) {
            $params['country'] = $country;
        }
        return $this->get('getCountries', $params);
    }

    /**
     * Retrieves the IP address of the requesting client.
     *
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getIP(): array
    {
        return $this->get('getIP');
    }

    /**
     * Retrieves available languages or information about a specific language.
     *
     * @param Language|null $language Optional. The specific language Enum.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLanguages(?Language $language = null): array
    {
        $params = [];
        if ($language !== null) {
            $params['language'] = $language->value;
        }
        return $this->get('getLanguages', $params);
    }

    /**
     * Retrieves available locales or information about a specific locale.
     *
     * @param string|null $locale Optional. The specific locale code (e.g., 'en_US').
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLocales(?string $locale = null): array
    {
        $params = [];
        if ($locale !== null) {
            $params['locale'] = $locale;
        }
        return $this->get('getLocales', $params);
    }

    /**
     * Retrieves information about Voip.ms servers.
     *
     * @param int|null $serverPop Optional. The specific server POP ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getServersInfo(?int $serverPop = null): array
    {
        $params = [];
        if ($serverPop !== null) {
            $params['server_pop'] = $serverPop;
        }
        return $this->get('getServersInfo', $params);
    }

    /**
     * Retrieves transaction history within a date range.
     *
     * @param string $dateFrom Start date (YYYY-MM-DD).
     * @param string $dateTo End date (YYYY-MM-DD).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getTransactionHistory(string $dateFrom, string $dateTo): array
    {
        $params = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
        return $this->get('getTransactionHistory', $params);
    }

    /**
     * Adds a member to a conference.
     * Note: API docs list this under General Functions and parameters imply GET.
     *
     * @param int $member The member ID to add.
     * @param int $conference The conference ID to add the member to.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function addMemberToConference(int $member, int $conference): array
    {
        $params = [
            'member' => $member,
            'conference' => $conference,
        ];
        return $this->get('addMemberToConference', $params);
    }
}
