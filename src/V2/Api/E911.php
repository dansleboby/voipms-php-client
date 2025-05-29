<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\E911AddressType;
use VoipMs\V2\Enum\E911CountryOption;
use VoipMs\V2\Enum\E911LanguageOption;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'E911' API methods.
 */
class E911 extends AbstractApi
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
     * Retrieves E911 address types.
     *
     * @param E911AddressType|null $type Optional. Specific E911 address type to retrieve.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911AddressTypes(?E911AddressType $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type->value;
        }
        return $this->get('e911AddressTypes', $params);
    }

    /**
     * Cancels E911 service for a DID.
     *
     * @param string $did The DID number.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911Cancel(string $did): array
    {
        $params = ['did' => $did];
        return $this->post('e911Cancel', $params);
    }

    /**
     * Retrieves E911 information for a DID.
     *
     * @param string $did The DID number.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911Info(string $did): array
    {
        $params = ['did' => $did];
        return $this->get('e911Info', $params);
    }

    /**
     * Provisions E911 service for a DID.
     *
     * @param string $did The DID number.
     * @param string $fullName Full name for the E911 address.
     * @param int $streetNumber Street number.
     * @param string $streetName Street name.
     * @param string $city City.
     * @param E911CountryOption $country Country.
     * @param string $zipCode ZIP/postal code.
     * @param string $email Email address.
     * @param E911AddressType|null $addressType Optional. Address type.
     * @param int|null $addressNumber Optional. Address number (e.g., apartment/suite).
     * @param E911LanguageOption|null $language Optional. Language preference.
     * @param string|null $otherInfo Optional. Other relevant information.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911Provision(
        string $did,
        string $fullName,
        int $streetNumber,
        string $streetName,
        string $city,
        E911CountryOption $country,
        string $zipCode,
        string $email,
        ?E911AddressType $addressType = null,
        ?int $addressNumber = null,
        ?E911LanguageOption $language = null,
        ?string $otherInfo = null
    ): array {
        $params = [
            'did' => $did,
            'full_name' => $fullName,
            'street_number' => $streetNumber,
            'street_name' => $streetName,
            'city' => $city,
            'country' => $country->value,
            'zip_code' => $zipCode,
            'email' => $email,
        ];
        if ($addressType !== null) $params['address_type'] = $addressType->value;
        if ($addressNumber !== null) $params['address_number'] = $addressNumber;
        if ($language !== null) $params['language'] = $language->value;
        if ($otherInfo !== null) $params['other_info'] = $otherInfo;

        return $this->post('e911Provision', $params);
    }

    /**
     * Manually provisions E911 service for a DID.
     * (Parameters are identical to e911Provision)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911ProvisionManually(
        string $did,
        string $fullName,
        int $streetNumber,
        string $streetName,
        string $city,
        E911CountryOption $country,
        string $zipCode,
        string $email,
        ?E911AddressType $addressType = null,
        ?int $addressNumber = null,
        ?E911LanguageOption $language = null,
        ?string $otherInfo = null
    ): array {
        $params = [
            'did' => $did,
            'full_name' => $fullName,
            'street_number' => $streetNumber,
            'street_name' => $streetName,
            'city' => $city,
            'country' => $country->value,
            'zip_code' => $zipCode,
            'email' => $email,
        ];
        if ($addressType !== null) $params['address_type'] = $addressType->value;
        if ($addressNumber !== null) $params['address_number'] = $addressNumber;
        if ($language !== null) $params['language'] = $language->value;
        if ($otherInfo !== null) $params['other_info'] = $otherInfo;

        return $this->post('e911ProvisionManually', $params);
    }

    /**
     * Updates E911 service information for a DID.
     * (Parameters are identical to e911Provision)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911Update(
        string $did,
        string $fullName,
        int $streetNumber,
        string $streetName,
        string $city,
        E911CountryOption $country,
        string $zipCode,
        string $email,
        ?E911AddressType $addressType = null,
        ?int $addressNumber = null,
        ?E911LanguageOption $language = null,
        ?string $otherInfo = null
    ): array {
        $params = [
            'did' => $did,
            'full_name' => $fullName,
            'street_number' => $streetNumber,
            'street_name' => $streetName,
            'city' => $city,
            'country' => $country->value,
            'zip_code' => $zipCode,
            'email' => $email,
        ];
        if ($addressType !== null) $params['address_type'] = $addressType->value;
        if ($addressNumber !== null) $params['address_number'] = $addressNumber;
        if ($language !== null) $params['language'] = $language->value;
        if ($otherInfo !== null) $params['other_info'] = $otherInfo;

        return $this->post('e911Update', $params);
    }

    /**
     * Validates E911 address information.
     * (Parameters are identical to e911Provision)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function e911Validate(
        string $did,
        string $fullName,
        int $streetNumber,
        string $streetName,
        string $city,
        E911CountryOption $country,
        string $zipCode,
        string $email,
        ?E911AddressType $addressType = null,
        ?int $addressNumber = null,
        ?E911LanguageOption $language = null,
        ?string $otherInfo = null
    ): array {
        $params = [
            'did' => $did,
            'full_name' => $fullName,
            'street_number' => $streetNumber,
            'street_name' => $streetName,
            'city' => $city,
            'country' => $country->value,
            'zip_code' => $zipCode,
            'email' => $email,
        ];
        if ($addressType !== null) $params['address_type'] = $addressType->value;
        if ($addressNumber !== null) $params['address_number'] = $addressNumber;
        if ($language !== null) $params['language'] = $language->value;
        if ($otherInfo !== null) $params['other_info'] = $otherInfo;

        return $this->post('e911Validate', $params);
    }
}
