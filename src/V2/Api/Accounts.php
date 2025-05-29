<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'Accounts' API methods.
 */
class Accounts extends AbstractApi
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
     * Creates a new Sub Account.
     *
     * @param string $username The username for the new sub account.
     * @param Enum\ProtocolOption $protocol Protocol to be used.
     * @param Enum\AuthType $authType Authentication type.
     * @param Enum\DeviceType $deviceType Device type.
     * @param Enum\LockInternationalOption $lockInternational Setting for locking international calls.
     * @param Enum\RouteOption $internationalRoute Route for international calls.
     * @param string[] $allowedCodecs Array of allowed codecs (e.g., ['ulaw', 'alaw']).
     * @param Enum\DtmfMode $dtmfMode DTMF mode.
     * @param Enum\NatMode $nat NAT mode.
     * @param string|null $description Description for the sub account.
     * @param string|null $password Password for the sub account (required if auth_type is not IP based).
     * @param string|null $ip IP address (required if auth_type is IP based or IP + Password).
     * @param string|null $calleridNumber Caller ID number.
     * @param Enum\RouteOption|null $canadaRouting Route for Canadian calls.
     * @param Enum\OnOffInteger|null $allow225 Allow account to dial 225 area code.
     * @param string|null $musicOnHold Music on hold setting.
     * @param Enum\Language|null $language Language for the sub account.
     * @param Enum\OnOffInteger|null $recordCalls Record calls setting.
     * @param Enum\SipTrafficOption|null $sipTraffic Enable/disable SIP traffic.
     * @param int|null $maxExpiry Maximum SIP session expiry time.
     * @param int|null $rtpTimeout RTP timeout.
     * @param int|null $rtpHoldTimeout RTP hold timeout.
     * @param string|null $ipRestriction IP restriction for sub account.
     * @param Enum\OnOffInteger|null $enableIpRestriction Enable/disable IP restriction.
     * @param string|null $popRestriction POP restriction for sub account.
     * @param Enum\OnOffInteger|null $enablePopRestriction Enable/disable POP restriction.
     * @param Enum\OnOffInteger|null $sendBye Send BYE packet.
     * @param Enum\OnOffInteger|null $transcribe Enable/disable call transcription.
     * @param string|null $transcriptionLocale Locale for transcription.
     * @param string|null $transcriptionEmail Email for transcription notifications.
     * @param string|null $internalExtension Internal extension number.
     * @param string|null $internalVoicemail Internal voicemail ID.
     * @param int|null $internalDialtime Internal dial time.
     * @param string|null $resellerClient Reseller client ID.
     * @param string|null $resellerPackage Reseller package ID.
     * @param string|null $resellerNextBilling Reseller next billing date (YYYY-MM-DD).
     * @param Enum\YesNo|null $resellerChargeSetup Charge setup fee for reseller.
     * @param int|null $parkingLot Parking lot ID.
     * @param int|null $transcriptionStartDelay Transcription start delay in seconds.
     * @param Enum\OnOffInteger|null $enableInternalCnam Enable internal CNAM.
     * @param string|null $internalCnam Internal CNAM value.
     * @param Enum\CallPickupBehaviorOption|null $callPickupBehavior Call pickup behavior.
     * @param Enum\DialingModeOption|null $dialingMode Dialing mode.
     * @param Enum\TollFreeCarrierOption|null $tfCarrier Toll-Free carrier selection.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function createSubAccount(
        string $username,
        Enum\ProtocolOption $protocol,
        Enum\AuthType $authType,
        Enum\DeviceType $deviceType,
        Enum\LockInternationalOption $lockInternational,
        Enum\RouteOption $internationalRoute,
        array $allowedCodecs,
        Enum\DtmfMode $dtmfMode,
        Enum\NatMode $nat,
        ?string $description = null,
        ?string $password = null,
        ?string $ip = null,
        ?string $calleridNumber = null,
        ?Enum\RouteOption $canadaRouting = null,
        ?Enum\OnOffInteger $allow225 = null,
        ?string $musicOnHold = null,
        ?Enum\Language $language = null,
        ?Enum\OnOffInteger $recordCalls = null,
        ?Enum\SipTrafficOption $sipTraffic = null,
        ?int $maxExpiry = null,
        ?int $rtpTimeout = null,
        ?int $rtpHoldTimeout = null,
        ?string $ipRestriction = null,
        ?Enum\OnOffInteger $enableIpRestriction = null,
        ?string $popRestriction = null,
        ?Enum\OnOffInteger $enablePopRestriction = null,
        ?Enum\OnOffInteger $sendBye = null,
        ?Enum\OnOffInteger $transcribe = null,
        ?string $transcriptionLocale = null,
        ?string $transcriptionEmail = null,
        ?string $internalExtension = null,
        ?string $internalVoicemail = null,
        ?int $internalDialtime = null,
        ?string $resellerClient = null,
        ?string $resellerPackage = null,
        ?string $resellerNextBilling = null,
        ?Enum\YesNo $resellerChargeSetup = null,
        ?int $parkingLot = null,
        ?int $transcriptionStartDelay = null,
        ?Enum\OnOffInteger $enableInternalCnam = null,
        ?string $internalCnam = null,
        ?Enum\CallPickupBehaviorOption $callPickupBehavior = null,
        ?Enum\DialingModeOption $dialingMode = null,
        ?Enum\TollFreeCarrierOption $tfCarrier = null
    ): array {
        $params = [
            'username' => $username,
            'protocol' => $protocol->value,
            'auth_type' => $authType->value,
            'device_type' => $deviceType->value,
            'lock_international' => $lockInternational->value,
            'international_route' => $internationalRoute->value,
            'allowed_codecs' => implode(';', $allowedCodecs),
            'dtmf_mode' => $dtmfMode->value,
            'nat' => $nat->value,
        ];

        if ($description !== null) $params['description'] = $description;
        if ($password !== null) $params['password'] = $password;
        if ($ip !== null) $params['ip'] = $ip;
        if ($calleridNumber !== null) $params['callerid_number'] = $calleridNumber;
        if ($canadaRouting !== null) $params['canada_routing'] = $canadaRouting->value;
        if ($allow225 !== null) $params['allow_225'] = $allow225->value;
        if ($musicOnHold !== null) $params['music_on_hold'] = $musicOnHold;
        if ($language !== null) $params['language'] = $language->value;
        if ($recordCalls !== null) $params['record_calls'] = $recordCalls->value;
        if ($sipTraffic !== null) $params['sip_traffic'] = $sipTraffic->value;
        if ($maxExpiry !== null) $params['max_expiry'] = $maxExpiry;
        if ($rtpTimeout !== null) $params['rtp_timeout'] = $rtpTimeout;
        if ($rtpHoldTimeout !== null) $params['rtp_hold_timeout'] = $rtpHoldTimeout;
        if ($ipRestriction !== null) $params['ip_restriction'] = $ipRestriction;
        if ($enableIpRestriction !== null) $params['enable_ip_restriction'] = $enableIpRestriction->value;
        if ($popRestriction !== null) $params['pop_restriction'] = $popRestriction;
        if ($enablePopRestriction !== null) $params['enable_pop_restriction'] = $enablePopRestriction->value;
        if ($sendBye !== null) $params['send_bye'] = $sendBye->value;
        if ($transcribe !== null) $params['transcribe'] = $transcribe->value;
        if ($transcriptionLocale !== null) $params['transcription_locale'] = $transcriptionLocale;
        if ($transcriptionEmail !== null) $params['transcription_email'] = $transcriptionEmail;
        if ($internalExtension !== null) $params['internal_extension'] = $internalExtension;
        if ($internalVoicemail !== null) $params['internal_voicemail'] = $internalVoicemail;
        if ($internalDialtime !== null) $params['internal_dialtime'] = $internalDialtime;
        if ($resellerClient !== null) $params['reseller_client'] = $resellerClient;
        if ($resellerPackage !== null) $params['reseller_package'] = $resellerPackage;
        if ($resellerNextBilling !== null) $params['reseller_next_billing'] = $resellerNextBilling;
        if ($resellerChargeSetup !== null) $params['reseller_charge_setup'] = $resellerChargeSetup->value;
        if ($parkingLot !== null) $params['parking_lot'] = $parkingLot;
        if ($transcriptionStartDelay !== null) $params['transcription_start_delay'] = $transcriptionStartDelay;
        if ($enableInternalCnam !== null) $params['enable_internal_cnam'] = $enableInternalCnam->value;
        if ($internalCnam !== null) $params['internal_cnam'] = $internalCnam;
        if ($callPickupBehavior !== null) $params['call_pickup_behavior'] = $callPickupBehavior->value;
        if ($dialingMode !== null) $params['dialing_mode'] = $dialingMode->value;
        if ($tfCarrier !== null) $params['tf_carrier'] = $tfCarrier->value;
        
        return $this->post('createSubAccount', $params);
    }

    /**
     * Deletes a Sub Account.
     *
     * @param int $id The ID of the sub account to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delSubAccount(int $id): array
    {
        $params = ['id' => $id];
        return $this->post('delSubAccount', $params);
    }

    /**
     * Retrieves allowed codecs or information about a specific codec.
     *
     * @param string|null $codec Optional. The specific codec name (e.g., 'ulaw').
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getAllowedCodecs(?string $codec = null): array
    {
        $params = [];
        if ($codec !== null) {
            $params['codec'] = $codec;
        }
        return $this->get('getAllowedCodecs', $params);
    }

    /**
     * Retrieves authentication types or information about a specific auth type.
     *
     * @param Enum\AuthType|null $type Optional. The specific authentication type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getAuthTypes(?Enum\AuthType $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type->value;
        }
        return $this->get('getAuthTypes', $params);
    }

    /**
     * Retrieves device types or information about a specific device type.
     *
     * @param Enum\DeviceType|null $deviceType Optional. The specific device type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDeviceTypes(?Enum\DeviceType $deviceType = null): array
    {
        $params = [];
        if ($deviceType !== null) {
            $params['device_type'] = $deviceType->value;
        }
        return $this->get('getDeviceTypes', $params);
    }

    /**
     * Retrieves DTMF modes or information about a specific DTMF mode.
     *
     * @param Enum\DtmfMode|null $dtmfMode Optional. The specific DTMF mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDtmfModes(?Enum\DtmfMode $dtmfMode = null): array
    {
        $params = [];
        if ($dtmfMode !== null) {
            $params['dtmf_mode'] = $dtmfMode->value;
        }
        return $this->get('getDtmfModes', $params);
    }

    /**
     * Retrieves invoice information.
     *
     * @param string|null $from Optional. Start date (YYYY-MM-DD).
     * @param string|null $to Optional. End date (YYYY-MM-DD).
     * @param int|null $range Optional. Predefined range (e.g., 1 for current month).
     * @param int|null $type Optional. Invoice type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getInvoice(?string $from = null, ?string $to = null, ?int $range = null, ?int $type = null): array
    {
        $params = [];
        if ($from !== null) $params['from'] = $from;
        if ($to !== null) $params['to'] = $to;
        if ($range !== null) $params['range'] = $range;
        if ($type !== null) $params['type'] = $type;
        return $this->get('getInvoice', $params);
    }

    /**
     * Retrieves lock international options or information about a specific option.
     *
     * @param Enum\LockInternationalOption|null $lockInternational Optional. The specific lock international option.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getLockInternational(?Enum\LockInternationalOption $lockInternational = null): array
    {
        $params = [];
        if ($lockInternational !== null) {
            $params['lock_international'] = $lockInternational->value;
        }
        return $this->get('getLockInternational', $params);
    }

    /**
     * Retrieves Music On Hold options or a specific one.
     *
     * @param string|null $musicOnHold Optional. The name of the Music on Hold.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getMusicOnHold(?string $musicOnHold = null): array
    {
        $params = [];
        if ($musicOnHold !== null) {
            $params['music_on_hold'] = $musicOnHold;
        }
        return $this->get('getMusicOnHold', $params);
    }

    /**
     * Sets/Creates a Music On Hold entry.
     *
     * @param string $description Description for the Music on Hold.
     * @param string[] $recordings Array of recording IDs.
     * @param string|null $name Optional. Name for the Music on Hold. If not provided, one will be generated.
     * @param Enum\YesNo|null $volume Optional. Volume adjustment ('yes' for louder, 'no' for normal).
     * @param string|null $sort Optional. Sort order.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setMusicOnHold(string $description, array $recordings, ?string $name = null, ?Enum\YesNo $volume = null, ?string $sort = null): array
    {
        $params = [
            'description' => $description,
            'recordings' => implode(';', $recordings),
        ];
        if ($name !== null) $params['name'] = $name;
        if ($volume !== null) $params['volume'] = $volume->value;
        if ($sort !== null) $params['sort'] = $sort;
        
        return $this->post('setMusicOnHold', $params);
    }

    /**
     * Deletes a Music On Hold entry.
     *
     * @param string $musicOnHold The name of the Music on Hold to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delMusicOnHold(string $musicOnHold): array
    {
        $params = ['music_on_hold' => $musicOnHold];
        return $this->post('delMusicOnHold', $params);
    }

    /**
     * Retrieves NAT modes or information about a specific NAT mode.
     *
     * @param Enum\NatMode|null $nat Optional. The specific NAT mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getNat(?Enum\NatMode $nat = null): array
    {
        $params = [];
        if ($nat !== null) {
            $params['nat'] = $nat->value;
        }
        return $this->get('getNat', $params);
    }

    /**
     * Retrieves protocols or information about a specific protocol.
     *
     * @param Enum\ProtocolOption|null $protocol Optional. The specific protocol.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getProtocols(?Enum\ProtocolOption $protocol = null): array
    {
        $params = [];
        if ($protocol !== null) {
            $params['protocol'] = $protocol->value;
        }
        return $this->get('getProtocols', $params);
    }

    /**
     * Retrieves registration status for accounts.
     *
     * @param string|null $account Optional. Specific account (sub account or 'main') to check.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRegistrationStatus(?string $account = null): array
    {
        $params = [];
        if ($account !== null) {
            $params['account'] = $account;
        }
        return $this->get('getRegistrationStatus', $params);
    }

    /**
     * Retrieves report estimated hold time types.
     *
     * @param Enum\ReportEstimateHoldTimeType|null $type Optional. The specific type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getReportEstimatedHoldTime(?Enum\ReportEstimateHoldTimeType $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type->value;
        }
        return $this->get('getReportEstimatedHoldTime', $params);
    }

    /**
     * Retrieves routes or information about a specific route.
     *
     * @param Enum\RouteOption|null $route Optional. The specific route.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRoutes(?Enum\RouteOption $route = null): array
    {
        $params = [];
        if ($route !== null) {
            $params['route'] = $route->value;
        }
        return $this->get('getRoutes', $params);
    }

    /**
     * Retrieves Sub Accounts or information about a specific sub account.
     *
     * @param string|null $account Optional. The specific sub account username.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getSubAccounts(?string $account = null): array
    {
        $params = [];
        if ($account !== null) {
            $params['account'] = $account;
        }
        return $this->get('getSubAccounts', $params);
    }

    /**
     * Updates an existing Sub Account.
     *
     * @param int $id The ID of the sub account to update.
     * @param Enum\AuthType $authType Authentication type.
     * @param Enum\DeviceType $deviceType Device type.
     * @param Enum\LockInternationalOption $lockInternational Setting for locking international calls.
     * @param Enum\RouteOption $internationalRoute Route for international calls.
     * @param string[] $allowedCodecs Array of allowed codecs (e.g., ['ulaw', 'alaw']).
     * @param Enum\DtmfMode $dtmfMode DTMF mode.
     * @param Enum\NatMode $nat NAT mode.
     * @param string|null $description Description for the sub account.
     * @param string|null $password Password for the sub account.
     * @param string|null $ip IP address.
     * @param string|null $calleridNumber Caller ID number.
     * @param Enum\RouteOption|null $canadaRouting Route for Canadian calls.
     * @param Enum\OnOffInteger|null $allow225 Allow account to dial 225 area code.
     * @param string|null $musicOnHold Music on hold setting.
     * @param Enum\Language|null $language Language for the sub account.
     * @param Enum\OnOffInteger|null $recordCalls Record calls setting.
     * @param Enum\SipTrafficOption|null $sipTraffic Enable/disable SIP traffic.
     * @param int|null $maxExpiry Maximum SIP session expiry time.
     * @param int|null $rtpTimeout RTP timeout.
     * @param int|null $rtpHoldTimeout RTP hold timeout.
     * @param string|null $ipRestriction IP restriction for sub account.
     * @param Enum\OnOffInteger|null $enableIpRestriction Enable/disable IP restriction.
     * @param string|null $popRestriction POP restriction for sub account.
     * @param Enum\OnOffInteger|null $enablePopRestriction Enable/disable POP restriction.
     * @param Enum\OnOffInteger|null $sendBye Send BYE packet.
     * @param string|null $internalExtension Internal extension number.
     * @param string|null $internalVoicemail Internal voicemail ID.
     * @param int|null $internalDialtime Internal dial time.
     * @param string|null $resellerClient Reseller client ID.
     * @param string|null $resellerPackage Reseller package ID.
     * @param string|null $resellerNextBilling Reseller next billing date (YYYY-MM-DD).
     * @param Enum\YesNo|null $resellerChargeSetup Charge setup fee for reseller.
     * @param int|null $parkingLot Parking lot ID.
     * @param int|null $transcriptionStartDelay Transcription start delay in seconds.
     * @param Enum\OnOffInteger|null $enableInternalCnam Enable internal CNAM.
     * @param string|null $internalCnam Internal CNAM value.
     * @param Enum\CallPickupBehaviorOption|null $callPickupBehavior Call pickup behavior.
     * @param Enum\DialingModeOption|null $dialingMode Dialing mode.
     * @param Enum\TollFreeCarrierOption|null $tfCarrier Toll-Free carrier selection.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setSubAccount(
        int $id,
        Enum\AuthType $authType,
        Enum\DeviceType $deviceType,
        Enum\LockInternationalOption $lockInternational,
        Enum\RouteOption $internationalRoute,
        array $allowedCodecs,
        Enum\DtmfMode $dtmfMode,
        Enum\NatMode $nat,
        ?string $description = null,
        ?string $password = null,
        ?string $ip = null,
        ?string $calleridNumber = null,
        ?Enum\RouteOption $canadaRouting = null,
        ?Enum\OnOffInteger $allow225 = null,
        ?string $musicOnHold = null,
        ?Enum\Language $language = null,
        ?Enum\OnOffInteger $recordCalls = null,
        ?Enum\SipTrafficOption $sipTraffic = null,
        ?int $maxExpiry = null,
        ?int $rtpTimeout = null,
        ?int $rtpHoldTimeout = null,
        ?string $ipRestriction = null,
        ?Enum\OnOffInteger $enableIpRestriction = null,
        ?string $popRestriction = null,
        ?Enum\OnOffInteger $enablePopRestriction = null,
        ?Enum\OnOffInteger $sendBye = null,
        ?string $internalExtension = null,
        ?string $internalVoicemail = null,
        ?int $internalDialtime = null,
        ?string $resellerClient = null,
        ?string $resellerPackage = null,
        ?string $resellerNextBilling = null,
        ?Enum\YesNo $resellerChargeSetup = null,
        ?int $parkingLot = null,
        ?int $transcriptionStartDelay = null,
        ?Enum\OnOffInteger $enableInternalCnam = null,
        ?string $internalCnam = null,
        ?Enum\CallPickupBehaviorOption $callPickupBehavior = null,
        ?Enum\DialingModeOption $dialingMode = null,
        ?Enum\TollFreeCarrierOption $tfCarrier = null
    ): array {
        $params = [
            'id' => $id,
            'auth_type' => $authType->value,
            'device_type' => $deviceType->value,
            'lock_international' => $lockInternational->value,
            'international_route' => $internationalRoute->value,
            'allowed_codecs' => implode(';', $allowedCodecs),
            'dtmf_mode' => $dtmfMode->value,
            'nat' => $nat->value,
        ];

        if ($description !== null) $params['description'] = $description;
        if ($password !== null) $params['password'] = $password;
        if ($ip !== null) $params['ip'] = $ip;
        if ($calleridNumber !== null) $params['callerid_number'] = $calleridNumber;
        if ($canadaRouting !== null) $params['canada_routing'] = $canadaRouting->value;
        if ($allow225 !== null) $params['allow_225'] = $allow225->value;
        if ($musicOnHold !== null) $params['music_on_hold'] = $musicOnHold;
        if ($language !== null) $params['language'] = $language->value;
        if ($recordCalls !== null) $params['record_calls'] = $recordCalls->value;
        if ($sipTraffic !== null) $params['sip_traffic'] = $sipTraffic->value;
        if ($maxExpiry !== null) $params['max_expiry'] = $maxExpiry;
        if ($rtpTimeout !== null) $params['rtp_timeout'] = $rtpTimeout;
        if ($rtpHoldTimeout !== null) $params['rtp_hold_timeout'] = $rtpHoldTimeout;
        if ($ipRestriction !== null) $params['ip_restriction'] = $ipRestriction;
        if ($enableIpRestriction !== null) $params['enable_ip_restriction'] = $enableIpRestriction->value;
        if ($popRestriction !== null) $params['pop_restriction'] = $popRestriction;
        if ($enablePopRestriction !== null) $params['enable_pop_restriction'] = $enablePopRestriction->value;
        if ($sendBye !== null) $params['send_bye'] = $sendBye->value;
        // Note: 'transcribe', 'transcription_locale', 'transcription_email' are not listed for setSubAccount in docs.
        // If they were, they would be added here.
        if ($internalExtension !== null) $params['internal_extension'] = $internalExtension;
        if ($internalVoicemail !== null) $params['internal_voicemail'] = $internalVoicemail;
        if ($internalDialtime !== null) $params['internal_dialtime'] = $internalDialtime;
        if ($resellerClient !== null) $params['reseller_client'] = $resellerClient;
        if ($resellerPackage !== null) $params['reseller_package'] = $resellerPackage;
        if ($resellerNextBilling !== null) $params['reseller_next_billing'] = $resellerNextBilling;
        if ($resellerChargeSetup !== null) $params['reseller_charge_setup'] = $resellerChargeSetup->value;
        if ($parkingLot !== null) $params['parking_lot'] = $parkingLot;
        if ($transcriptionStartDelay !== null) $params['transcription_start_delay'] = $transcriptionStartDelay;
        if ($enableInternalCnam !== null) $params['enable_internal_cnam'] = $enableInternalCnam->value;
        if ($internalCnam !== null) $params['internal_cnam'] = $internalCnam;
        if ($callPickupBehavior !== null) $params['call_pickup_behavior'] = $callPickupBehavior->value;
        if ($dialingMode !== null) $params['dialing_mode'] = $dialingMode->value;
        if ($tfCarrier !== null) $params['tf_carrier'] = $tfCarrier->value;

        return $this->post('setSubAccount', $params);
    }
}
