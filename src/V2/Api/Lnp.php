<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\LnpPortType;
use VoipMs\V2\Enum\OnOffInteger;
use VoipMs\V2\Enum\LnpLocationType;
use VoipMs\V2\Enum\CountryOption;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'LNP' (Local Number Portability) API methods.
 */
class Lnp extends AbstractApi
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
     * Adds an LNP (Local Number Portability) port request.
     *
     * @param LnpPortType $portType Type of port.
     * @param string $numbers Comma-separated list of numbers to port.
     * @param string $firstName First name of the account holder.
     * @param string $lastName Last name of the account holder.
     * @param string $address1 Primary address line.
     * @param string $city City.
     * @param string $zip ZIP/postal code.
     * @param string $state State/province.
     * @param CountryOption $country Country.
     * @param string $providerName Current provider's name.
     * @param string $providerAccount Current provider's account number.
     * @param OnOffInteger|null $isPartial Optional. Is this a partial port?
     * @param LnpLocationType|null $locationType Optional. Location type (Residential/Business).
     * @param OnOffInteger|null $isMobile Optional. Is this a mobile number?
     * @param string|null $pin Optional. PIN for the account with the current provider.
     * @param string|null $imei Optional. IMEI for mobile numbers.
     * @param string|null $btn Optional. Billing Telephone Number.
     * @param string|null $services Optional. Additional services on the account.
     * @param int|null $tfType Optional. Toll-Free type if applicable.
     * @param string|null $statementName Optional. Name as it appears on the statement.
     * @param string|null $address2 Optional. Secondary address line.
     * @param string|null $notes Optional. Additional notes for the port request.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function addLNPPort(
        LnpPortType $portType,
        string $numbers,
        string $firstName,
        string $lastName,
        string $address1,
        string $city,
        string $zip,
        string $state,
        CountryOption $country,
        string $providerName,
        string $providerAccount,
        ?OnOffInteger $isPartial = null,
        ?LnpLocationType $locationType = null,
        ?OnOffInteger $isMobile = null,
        ?string $pin = null,
        ?string $imei = null,
        ?string $btn = null,
        ?string $services = null,
        ?int $tfType = null,
        ?string $statementName = null,
        ?string $address2 = null,
        ?string $notes = null
    ): array {
        $params = [
            'portType' => $portType->value,
            'numbers' => $numbers,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'address1' => $address1,
            'city' => $city,
            'zip' => $zip,
            'state' => $state,
            'country' => $country->value,
            'providerName' => $providerName,
            'providerAccount' => $providerAccount,
        ];

        if ($isPartial !== null) $params['isPartial'] = $isPartial->value;
        if ($locationType !== null) $params['locationType'] = $locationType->value;
        if ($isMobile !== null) $params['isMobile'] = $isMobile->value;
        if ($pin !== null) $params['pin'] = $pin;
        if ($imei !== null) $params['imei'] = $imei;
        if ($btn !== null) $params['btn'] = $btn;
        if ($services !== null) $params['services'] = $services;
        if ($tfType !== null) $params['tfType'] = $tfType;
        if ($statementName !== null) $params['statementName'] = $statementName;
        if ($address2 !== null) $params['address2'] = $address2;
        if ($notes !== null) $params['notes'] = $notes;

        return $this->post('addLNPPort', $params);
    }

    /**
     * Adds a file attachment to an LNP port request.
     *
     * @param int $portId The ID of the LNP port request.
     * @param string $fileBase64 Base64 encoded content of the file.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function addLNPFile(int $portId, string $fileBase64): array
    {
        $params = [
            'portid' => $portId,
            'file' => $fileBase64,
        ];
        return $this->post('addLNPFile', $params);
    }

    /**
     * Retrieves the status of an LNP port request.
     *
     * @param int $portId The ID of the LNP port request.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPStatus(int $portId): array
    {
        $params = ['portid' => $portId];
        return $this->get('getLNPStatus', $params);
    }

    /**
     * Retrieves notes for an LNP port request.
     *
     * @param int $portId The ID of the LNP port request.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPNotes(int $portId): array
    {
        $params = ['portid' => $portId];
        return $this->get('getLNPNotes', $params);
    }

    /**
     * Retrieves a list of possible LNP port statuses.
     *
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPListStatus(): array
    {
        return $this->get('getLNPListStatus');
    }

    /**
     * Retrieves a list of LNP port requests based on filters.
     *
     * @param int|null $portId Optional. Filter by specific port ID.
     * @param string|null $portStatus Optional. Filter by port status.
     * @param string|null $startDate Optional. Filter by start date (YYYY-MM-DD).
     * @param string|null $endDate Optional. Filter by end date (YYYY-MM-DD).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPList(?int $portId = null, ?string $portStatus = null, ?string $startDate = null, ?string $endDate = null): array
    {
        $params = [];
        if ($portId !== null) $params['portid'] = $portId;
        if ($portStatus !== null) $params['portStatus'] = $portStatus;
        if ($startDate !== null) $params['startDate'] = $startDate;
        if ($endDate !== null) $params['endDate'] = $endDate;
        return $this->get('getLNPList', $params);
    }

    /**
     * Retrieves detailed information for an LNP port request.
     *
     * @param int $portId The ID of the LNP port request.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPDetails(int $portId): array
    {
        $params = ['portid' => $portId];
        return $this->get('getLNPDetails', $params);
    }

    /**
     * Retrieves a list of attachments for an LNP port request.
     *
     * @param int $portId The ID of the LNP port request.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPAttachList(int $portId): array
    {
        $params = ['portid' => $portId];
        return $this->get('getLNPAttachList', $params);
    }

    /**
     * Retrieves a specific attachment for an LNP port request.
     *
     * @param int $attachId The ID of the attachment.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLNPAttach(int $attachId): array
    {
        $params = ['attachid' => $attachId];
        return $this->get('getLNPAttach', $params);
    }
}
