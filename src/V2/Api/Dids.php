<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\BillingType;
use VoipMs\V2\Enum\OnOffInteger;
use VoipMs\V2\Enum\YesNo;
use VoipMs\V2\Enum\InternationalDidType;
use VoipMs\V2\Enum\SmsMessageType;
use VoipMs\V2\Enum\JoinWhenEmptyType;
use VoipMs\V2\Enum\RingStrategy;
use VoipMs\V2\Enum\VoicemailSetupOption;
use VoipMs\V2\Enum\EmailAttachmentFormat;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'DIDs' (Direct Inward Dialing) API methods.
 */
class Dids extends AbstractApi
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
     * Backorders DIDs in the USA.
     *
     * @param int $quantity Number of DIDs to order.
     * @param string $state State for the DIDs.
     * @param string $ratecenter Rate center for the DIDs.
     * @param string $routing Routing configuration.
     * @param BillingType $billingType Billing type for the DIDs.
     * @param string|null $failoverBusy Failover routing for busy.
     * @param string|null $failoverUnreachable Failover routing for unreachable.
     * @param string|null $failoverNoanswer Failover routing for no answer.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $pop Point of Presence ID.
     * @param int|null $dialtime Dial time.
     * @param OnOffInteger|null $cnam CNAM setting.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $note Note for the order.
     * @param YesNo|null $test Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function backOrderDIDUSA(
        int $quantity,
        string $state,
        string $ratecenter,
        string $routing,
        BillingType $billingType,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'quantity' => $quantity,
            'state' => $state,
            'ratecenter' => $ratecenter,
            'routing' => $routing,
            'billing_type' => $billingType->value,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('backOrderDIDUSA', $params);
    }

    /**
     * Backorders DIDs in Canada.
     *
     * @param int $quantity Number of DIDs to order.
     * @param string $province Province for the DIDs.
     * @param string $ratecenter Rate center for the DIDs.
     * @param string $routing Routing configuration.
     * @param BillingType $billingType Billing type for the DIDs.
     * @param string|null $failoverBusy Failover routing for busy.
     * @param string|null $failoverUnreachable Failover routing for unreachable.
     * @param string|null $failoverNoanswer Failover routing for no answer.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $pop Point of Presence ID.
     * @param int|null $dialtime Dial time.
     * @param OnOffInteger|null $cnam CNAM setting.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $note Note for the order.
     * @param YesNo|null $test Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function backOrderDIDCAN(
        int $quantity,
        string $province,
        string $ratecenter,
        string $routing,
        BillingType $billingType,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'quantity' => $quantity,
            'province' => $province,
            'ratecenter' => $ratecenter,
            'routing' => $routing,
            'billing_type' => $billingType->value,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('backOrderDIDCAN', $params);
    }

    /**
     * Cancels a DID.
     *
     * @param string $did The DID number to cancel.
     * @param string|null $cancelComment Optional. Reason for cancellation. API param: cancelcomment
     * @param YesNo|null $portout Optional. Is the DID being ported out?
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function cancelDID(string $did, ?string $cancelComment = null, ?YesNo $portout = null, ?YesNo $test = null): array
    {
        $params = ['did' => $did];
        if ($cancelComment !== null) $params['cancelcomment'] = $cancelComment; // API param is 'cancelcomment'
        if ($portout !== null) $params['portout'] = $portout->value;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('cancelDID', $params);
    }

    /**
     * Connects a DID to a client account.
     *
     * @param string $did The DID number.
     * @param string $account The client account or sub-account.
     * @param float $monthly Monthly charge for the DID.
     * @param float $setup Setup charge for the DID.
     * @param float $minute Per-minute charge for the DID.
     * @param string|null $nextBilling Optional. Next billing date (YYYY-MM-DD).
     * @param YesNo|null $dontChargeSetup Optional. Do not charge setup fee.
     * @param YesNo|null $dontChargeMonthly Optional. Do not charge monthly fee.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function connectDID(
        string $did,
        string $account,
        float $monthly,
        float $setup,
        float $minute,
        ?string $nextBilling = null,
        ?YesNo $dontChargeSetup = null,
        ?YesNo $dontChargeMonthly = null
    ): array {
        $params = [
            'did' => $did,
            'account' => $account,
            'monthly' => $monthly,
            'setup' => $setup,
            'minute' => $minute,
        ];
        if ($nextBilling !== null) $params['next_billing'] = $nextBilling;
        if ($dontChargeSetup !== null) $params['dont_charge_setup'] = $dontChargeSetup->value;
        if ($dontChargeMonthly !== null) $params['dont_charge_monthly'] = $dontChargeMonthly->value;

        return $this->post('connectDID', $params);
    }

    /**
     * Deletes a callback.
     *
     * @param int $callbackId The ID of the callback to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delCallback(int $callbackId): array
    {
        $params = ['callback' => $callbackId]; // API param is 'callback'
        return $this->post('delCallback', $params);
    }

    /**
     * Deletes a caller ID filtering rule.
     *
     * @param int $filteringId The ID of the filtering rule to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delCallerIDFiltering(int $filteringId): array
    {
        $params = ['filtering' => $filteringId]; // API param is 'filtering'
        return $this->post('delCallerIDFiltering', $params);
    }

    /**
     * Deletes a call hunting setup.
     *
     * @param int $callHuntingId The ID of the call hunting setup to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delCallHunting(int $callHuntingId): array
    {
        $params = ['callhunting' => $callHuntingId]; // API param is 'callhunting'
        return $this->post('delCallHunting', $params);
    }

    /**
     * Deletes a conference.
     *
     * @param int $conferenceId The ID of the conference to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delConference(int $conferenceId): array
    {
        $params = ['conference' => $conferenceId]; // API param is 'conference'
        return $this->post('delConference', $params);
    }

    /**
     * Deletes a conference member.
     *
     * @param int $memberId The ID of the conference member to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delConferenceMember(int $memberId): array
    {
        $params = ['member' => $memberId]; // API param is 'member'
        return $this->post('delConferenceMember', $params);
    }
    
    /**
     * Deletes a sequence.
     *
     * @param int $sequenceId The ID of the sequence to delete.
     * @param int|null $clientId Optional. Client ID for reseller.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delSequences(int $sequenceId, ?int $clientId = null): array
    {
        $params = ['sequence' => $sequenceId]; // API param is 'sequence'
        if ($clientId !== null) $params['client'] = $clientId;
        return $this->post('delSequences', $params);
    }

    /**
     * Deletes a client.
     *
     * @param int $clientId The ID of the client to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delClient(int $clientId): array
    {
        $params = ['client' => $clientId]; // API param is 'client'
        return $this->post('delClient', $params);
    }

    /**
     * Deletes a DISA configuration.
     *
     * @param int $disaId The ID of the DISA configuration to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delDISA(int $disaId): array
    {
        $params = ['disa' => $disaId]; // API param is 'disa'
        return $this->post('delDISA', $params);
    }

    /**
     * Deletes an SMS message.
     *
     * @param int $smsId The ID of the SMS message to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function deleteSms(int $smsId): array
    {
        $params = ['id' => $smsId]; // API param is 'id'
        return $this->post('deleteSms', $params);
    }

    /**
     * Deletes an MMS message.
     *
     * @param int $mmsId The ID of the MMS message to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function deleteMms(int $mmsId): array
    {
        $params = ['id' => $mmsId]; // API param is 'id'
        return $this->post('deleteMms', $params);
    }

    /**
     * Deletes a forwarding setup.
     *
     * @param int $forwardingId The ID of the forwarding setup to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delForwarding(int $forwardingId): array
    {
        $params = ['forwarding' => $forwardingId]; // API param is 'forwarding'
        return $this->post('delForwarding', $params);
    }

    /**
     * Deletes an IVR.
     *
     * @param int $ivrId The ID of the IVR to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delIVR(int $ivrId): array
    {
        $params = ['ivr' => $ivrId]; // API param is 'ivr'
        return $this->post('delIVR', $params);
    }

    /**
     * Deletes a phonebook entry.
     *
     * @param int $phonebookId The ID of the phonebook entry to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delPhonebook(int $phonebookId): array
    {
        $params = ['phonebook' => $phonebookId]; // API param is 'phonebook'
        return $this->post('delPhonebook', $params);
    }

    /**
     * Deletes a phonebook group.
     *
     * @param int $groupId The ID of the phonebook group to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delPhonebookGroup(int $groupId): array
    {
        $params = ['group' => $groupId]; // API param is 'group'
        return $this->post('delPhonebookGroup', $params);
    }

    /**
     * Deletes a queue.
     *
     * @param int $queueId The ID of the queue to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delQueue(int $queueId): array
    {
        $params = ['queue' => $queueId]; // API param is 'queue'
        return $this->post('delQueue', $params);
    }

    /**
     * Deletes a recording.
     *
     * @param int $recordingId The ID of the recording to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delRecording(int $recordingId): array
    {
        $params = ['recording' => $recordingId]; // API param is 'recording'
        return $this->post('delRecording', $params);
    }

    /**
     * Deletes a ring group.
     *
     * @param int $ringGroupId The ID of the ring group to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delRingGroup(int $ringGroupId): array
    {
        $params = ['ringgroup' => $ringGroupId]; // API param is 'ringgroup'
        return $this->post('delRingGroup', $params);
    }

    /**
     * Deletes a SIP URI.
     *
     * @param int $sipUriId The ID of the SIP URI to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delSIPURI(int $sipUriId): array
    {
        $params = ['sipuri' => $sipUriId]; // API param is 'sipuri'
        return $this->post('delSIPURI', $params);
    }

    /**
     * Deletes a static member from a queue.
     *
     * @param int $memberId The ID of the member to delete.
     * @param int $queueId The ID of the queue.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delStaticMember(int $memberId, int $queueId): array
    {
        $params = [
            'member' => $memberId,
            'queue' => $queueId,
        ];
        return $this->post('delStaticMember', $params);
    }

    /**
     * Deletes a time condition.
     *
     * @param int $timeConditionId The ID of the time condition to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delTimeCondition(int $timeConditionId): array
    {
        $params = ['timecondition' => $timeConditionId]; // API param is 'timecondition'
        return $this->post('delTimeCondition', $params);
    }

    /**
     * Retrieves callbacks.
     *
     * @param int|null $callbackId Optional. Specific callback ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallbacks(?int $callbackId = null): array
    {
        $params = [];
        if ($callbackId !== null) $params['callback'] = $callbackId;
        return $this->get('getCallbacks', $params);
    }

    /**
     * Retrieves caller ID filtering rules.
     *
     * @param int|null $filteringId Optional. Specific filtering ID.
     * @param string|null $did Optional. DID number to filter by.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallerIDFiltering(?int $filteringId = null, ?string $did = null): array
    {
        $params = [];
        if ($filteringId !== null) $params['filtering_id'] = $filteringId; // API param is 'filtering_id' based on common patterns, not filtering
        if ($did !== null) $params['did'] = $did;
        return $this->get('getCallerIDFiltering', $params);
    }

    /**
     * Retrieves call hunting setups.
     *
     * @param int|null $callHuntingId Optional. Specific call hunting ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCallHuntings(?int $callHuntingId = null): array
    {
        $params = [];
        if ($callHuntingId !== null) $params['callhunting'] = $callHuntingId;
        return $this->get('getCallHuntings', $params);
    }

    /**
     * Retrieves carrier information.
     *
     * @param string|null $carrierCode Optional. Specific carrier code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCarriers(?string $carrierCode = null): array
    {
        $params = [];
        if ($carrierCode !== null) $params['carrier'] = $carrierCode;
        return $this->get('getCarriers', $params);
    }

    /**
     * Retrieves DID countries based on type.
     *
     * @param InternationalDidType $type Type of international DID.
     * @param string|null $countryId Optional. Specific country ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDCountries(InternationalDidType $type, ?string $countryId = null): array
    {
        $params = ['type' => $type->value];
        if ($countryId !== null) $params['country_id'] = $countryId;
        return $this->get('getDIDCountries', $params);
    }

    /**
     * Retrieves Canadian DIDs.
     *
     * @param string $province Province code.
     * @param string|null $ratecenter Optional. Rate center.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsCAN(string $province, ?string $ratecenter = null): array
    {
        $params = ['province' => $province];
        if ($ratecenter !== null) $params['ratecenter'] = $ratecenter;
        return $this->get('getDIDsCAN', $params);
    }

    /**
     * Retrieves DIDs information.
     *
     * @param string|null $did Optional. DID number.
     * @param string|null $client Optional. Client ID or sub-account username.
     * @param bool|null $smsAvailable Optional. Filter by SMS availability.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsInfo(?string $did = null, ?string $client = null, ?bool $smsAvailable = null): array
    {
        $params = [];
        if ($did !== null) $params['did'] = $did;
        if ($client !== null) $params['client'] = $client;
        if ($smsAvailable !== null) $params['sms_available'] = $smsAvailable ? '1' : '0';
        return $this->get('getDIDsInfo', $params);
    }

    /**
     * Retrieves international geographic DIDs for a country.
     *
     * @param string $countryId Country ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsInternationalGeographic(string $countryId): array
    {
        $params = ['country_id' => $countryId];
        return $this->get('getDIDsInternationalGeographic', $params);
    }

    /**
     * Retrieves international national DIDs for a country.
     *
     * @param string $countryId Country ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsInternationalNational(string $countryId): array
    {
        $params = ['country_id' => $countryId];
        return $this->get('getDIDsInternationalNational', $params);
    }

    /**
     * Retrieves international toll-free DIDs for a country.
     *
     * @param string $countryId Country ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsInternationalTollFree(string $countryId): array
    {
        $params = ['country_id' => $countryId];
        return $this->get('getDIDsInternationalTollFree', $params);
    }

    /**
     * Retrieves USA DIDs.
     *
     * @param string $state State code.
     * @param string|null $ratecenter Optional. Rate center.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDsUSA(string $state, ?string $ratecenter = null): array
    {
        $params = ['state' => $state];
        if ($ratecenter !== null) $params['ratecenter'] = $ratecenter;
        return $this->get('getDIDsUSA', $params);
    }

    /**
     * Retrieves vPRI DID information.
     *
     * @param int $vpri vPRI client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDIDvPRI(int $vpri): array
    {
        $params = ['vpri' => $vpri];
        return $this->get('getDIDvPRI', $params);
    }

    /**
     * Retrieves DISA configurations.
     *
     * @param int|null $disaId Optional. Specific DISA ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDISAs(?int $disaId = null): array
    {
        $params = [];
        if ($disaId !== null) $params['disa'] = $disaId;
        return $this->get('getDISAs', $params);
    }

    /**
     * Retrieves forwarding setups.
     *
     * @param int|null $forwardingId Optional. Specific forwarding ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getForwardings(?int $forwardingId = null): array
    {
        $params = [];
        if ($forwardingId !== null) $params['forwarding'] = $forwardingId;
        return $this->get('getForwardings', $params);
    }

    /**
     * Retrieves international DID types.
     *
     * @param InternationalDidType|null $type Optional. Specific international DID type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getInternationalTypes(?InternationalDidType $type = null): array
    {
        $params = [];
        if ($type !== null) $params['type'] = $type->value;
        return $this->get('getInternationalTypes', $params);
    }

    /**
     * Retrieves IVRs.
     *
     * @param int|null $ivrId Optional. Specific IVR ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getIVRs(?int $ivrId = null): array
    {
        $params = [];
        if ($ivrId !== null) $params['ivr'] = $ivrId;
        return $this->get('getIVRs', $params);
    }

    /**
     * Retrieves join when empty types for queues.
     *
     * @param JoinWhenEmptyType|null $type Optional. Specific join when empty type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getJoinWhenEmptyTypes(?JoinWhenEmptyType $type = null): array
    {
        $params = [];
        if ($type !== null) $params['type'] = $type->value;
        return $this->get('getJoinWhenEmptyTypes', $params);
    }

    /**
     * Retrieves MMS messages.
     *
     * @param int|null $mmsId Optional. Specific MMS ID. API param 'mms'.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD). API param 'from'.
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD). API param 'to'.
     * @param SmsMessageType|null $type Optional. Message type.
     * @param string|null $did Optional. DID number.
     * @param string|null $contact Optional. Contact number.
     * @param int|null $limit Optional. Limit number of results.
     * @param string|null $timezone Optional. Timezone.
     * @param OnOffInteger|null $allMessages Optional. Get all messages.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getMMS(
        ?int $mmsId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?SmsMessageType $type = null,
        ?string $did = null,
        ?string $contact = null,
        ?int $limit = null,
        ?string $timezone = null,
        ?OnOffInteger $allMessages = null
    ): array {
        $params = [];
        if ($mmsId !== null) $params['mms'] = $mmsId;
        if ($dateFrom !== null) $params['from'] = $dateFrom;
        if ($dateTo !== null) $params['to'] = $dateTo;
        if ($type !== null) $params['type'] = $type->value;
        if ($did !== null) $params['did'] = $did;
        if ($contact !== null) $params['contact'] = $contact;
        if ($limit !== null) $params['limit'] = $limit;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($allMessages !== null) $params['all_messages'] = $allMessages->value;
        return $this->get('getMMS', $params);
    }

    /**
     * Retrieves media for an MMS message.
     *
     * @param int $mmsId MMS ID. API param 'id'.
     * @param OnOffInteger|null $mediaAsArray Optional. Return media as array.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getMediaMMS(int $mmsId, ?OnOffInteger $mediaAsArray = null): array
    {
        $params = ['id' => $mmsId];
        if ($mediaAsArray !== null) $params['media_as_array'] = $mediaAsArray->value;
        return $this->get('getMediaMMS', $params);
    }

    /**
     * Retrieves phonebook entries.
     *
     * @param int|null $phonebookId Optional. Specific phonebook ID.
     * @param string|null $name Optional. Name to search for.
     * @param int|null $groupId Optional. Group ID.
     * @param string|null $groupName Optional. Group name.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getPhonebook(?int $phonebookId = null, ?string $name = null, ?int $groupId = null, ?string $groupName = null): array
    {
        $params = [];
        if ($phonebookId !== null) $params['phonebook'] = $phonebookId;
        if ($name !== null) $params['name'] = $name;
        if ($groupId !== null) $params['group'] = $groupId;
        if ($groupName !== null) $params['group_name'] = $groupName;
        return $this->get('getPhonebook', $params);
    }

    /**
     * Retrieves phonebook groups.
     *
     * @param string|null $name Optional. Group name to search for.
     * @param int|null $groupId Optional. Specific group ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getPhonebookGroups(?string $name = null, ?int $groupId = null): array
    {
        $params = [];
        if ($name !== null) $params['name'] = $name;
        if ($groupId !== null) $params['group'] = $groupId;
        return $this->get('getPhonebookGroups', $params);
    }

    /**
     * Retrieves portability information for a DID.
     *
     * @param string $did DID number.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getPortability(string $did): array
    {
        $params = ['did' => $did];
        return $this->get('getPortability', $params);
    }

    /**
     * Retrieves Canadian provinces.
     *
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getProvinces(): array
    {
        return $this->get('getProvinces');
    }

    /**
     * Retrieves queues.
     *
     * @param int|null $queueId Optional. Specific queue ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getQueues(?int $queueId = null): array
    {
        $params = [];
        if ($queueId !== null) $params['queue'] = $queueId;
        return $this->get('getQueues', $params);
    }

    /**
     * Retrieves Canadian rate centers for a province.
     *
     * @param string $province Province code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRateCentersCAN(string $province): array
    {
        $params = ['province' => $province];
        return $this->get('getRateCentersCAN', $params);
    }

    /**
     * Retrieves USA rate centers for a state.
     *
     * @param string $state State code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRateCentersUSA(string $state): array
    {
        $params = ['state' => $state];
        return $this->get('getRateCentersUSA', $params);
    }

    /**
     * Retrieves recordings.
     *
     * @param int|null $recordingId Optional. Specific recording ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRecordings(?int $recordingId = null): array
    {
        $params = [];
        if ($recordingId !== null) $params['recording'] = $recordingId;
        return $this->get('getRecordings', $params);
    }

    /**
     * Retrieves a recording file.
     *
     * @param int $recordingId Recording ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRecordingFile(int $recordingId): array
    {
        $params = ['recording' => $recordingId];
        return $this->get('getRecordingFile', $params);
    }

    /**
     * Retrieves ring groups.
     *
     * @param int|null $ringGroupId Optional. Specific ring group ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRingGroups(?int $ringGroupId = null): array
    {
        $params = [];
        if ($ringGroupId !== null) $params['ring_group'] = $ringGroupId;
        return $this->get('getRingGroups', $params);
    }

    /**
     * Retrieves ring strategies.
     *
     * @param RingStrategy|null $strategy Optional. Specific ring strategy.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getRingStrategies(?RingStrategy $strategy = null): array
    {
        $params = [];
        if ($strategy !== null) $params['strategy'] = $strategy->value;
        return $this->get('getRingStrategies', $params);
    }

    /**
     * Retrieves SIP URIs.
     *
     * @param int|null $sipUriId Optional. Specific SIP URI ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getSIPURIs(?int $sipUriId = null): array
    {
        $params = [];
        if ($sipUriId !== null) $params['sipuri'] = $sipUriId;
        return $this->get('getSIPURIs', $params);
    }

    /**
     * Retrieves SMS messages.
     *
     * @param int|null $smsId Optional. Specific SMS ID. API param 'sms'.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD). API param 'from'.
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD). API param 'to'.
     * @param SmsMessageType|null $type Optional. Message type.
     * @param string|null $did Optional. DID number.
     * @param string|null $contact Optional. Contact number.
     * @param int|null $limit Optional. Limit number of results.
     * @param string|null $timezone Optional. Timezone.
     * @param OnOffInteger|null $allMessages Optional. Get all messages.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getSMS(
        ?int $smsId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?SmsMessageType $type = null,
        ?string $did = null,
        ?string $contact = null,
        ?int $limit = null,
        ?string $timezone = null,
        ?OnOffInteger $allMessages = null
    ): array {
        $params = [];
        if ($smsId !== null) $params['sms'] = $smsId;
        if ($dateFrom !== null) $params['from'] = $dateFrom;
        if ($dateTo !== null) $params['to'] = $dateTo;
        if ($type !== null) $params['type'] = $type->value;
        if ($did !== null) $params['did'] = $did;
        if ($contact !== null) $params['contact'] = $contact;
        if ($limit !== null) $params['limit'] = $limit;
        if ($timezone !== null) $params['timezone'] = $timezone;
        if ($allMessages !== null) $params['all_messages'] = $allMessages->value;
        return $this->get('getSMS', $params);
    }

    /**
     * Retrieves USA states.
     *
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getStates(): array
    {
        return $this->get('getStates');
    }

    /**
     * Retrieves static members for a queue.
     *
     * @param int $queueId Queue ID.
     * @param int|null $memberId Optional. Specific member ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getStaticMembers(int $queueId, ?int $memberId = null): array
    {
        $params = ['queue' => $queueId];
        if ($memberId !== null) $params['member'] = $memberId;
        return $this->get('getStaticMembers', $params);
    }

    /**
     * Retrieves time conditions.
     *
     * @param int|null $timeConditionId Optional. Specific time condition ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getTimeConditions(?int $timeConditionId = null): array
    {
        $params = [];
        if ($timeConditionId !== null) $params['timecondition'] = $timeConditionId;
        return $this->get('getTimeConditions', $params);
    }

    /**
     * Retrieves voicemail setup options.
     *
     * @param VoicemailSetupOption|null $voicemailSetup Optional. Specific voicemail setup option.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemailSetups(?VoicemailSetupOption $voicemailSetup = null): array
    {
        $params = [];
        if ($voicemailSetup !== null) $params['voicemailsetup'] = $voicemailSetup->value;
        return $this->get('getVoicemailSetups', $params);
    }

    /**
     * Retrieves voicemail email attachment formats.
     *
     * @param EmailAttachmentFormat|null $format Optional. Specific email attachment format.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemailAttachmentFormats(?EmailAttachmentFormat $format = null): array
    {
        $params = [];
        if ($format !== null) $params['email_attachment_format'] = $format->value;
        return $this->get('getVoicemailAttachmentFormats', $params);
    }

    /**
     * Orders a specific DID.
     *
     * @param string $didNumber The DID number to order. API param: did
     * @param string $routing Routing configuration.
     * @param BillingType $billingType Billing type.
     * @param string|null $failoverBusy Failover routing for busy.
     * @param string|null $failoverUnreachable Failover routing for unreachable.
     * @param string|null $failoverNoanswer Failover routing for no answer.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $pop Point of Presence ID.
     * @param int|null $dialtime Dial time.
     * @param OnOffInteger|null $cnam CNAM setting.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $note Note for the order.
     * @param string|null $account Account to assign DID to (reseller).
     * @param float|null $monthly Monthly charge (reseller).
     * @param float|null $setup Setup charge (reseller).
     * @param float|null $minute Per-minute charge (reseller).
     * @param YesNo|null $test Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderDID(
        string $didNumber,
        string $routing,
        BillingType $billingType,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'did' => $didNumber, // API param is 'did'
            'routing' => $routing,
            'billing_type' => $billingType->value,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderDID', $params);
    }

    /**
     * Orders international geographic DIDs.
     *
     * @param string $locationId Location ID for the DIDs.
     * @param int $quantity Number of DIDs to order.
     * @param string $routing Routing configuration.
     * @param BillingType $billingType Billing type.
     * @param string|null $failoverBusy Failover routing for busy.
     * @param string|null $failoverUnreachable Failover routing for unreachable.
     * @param string|null $failoverNoanswer Failover routing for no answer.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $pop Point of Presence ID.
     * @param int|null $dialtime Dial time.
     * @param OnOffInteger|null $cnam CNAM setting.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $note Note for the order.
     * @param string|null $account Account to assign DIDs to (reseller).
     * @param float|null $monthly Monthly charge (reseller).
     * @param float|null $setup Setup charge (reseller).
     * @param float|null $minute Per-minute charge (reseller).
     * @param YesNo|null $test Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderDIDInternationalGeographic(
        string $locationId,
        int $quantity,
        string $routing,
        BillingType $billingType,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'location_id' => $locationId,
            'quantity' => $quantity,
            'routing' => $routing,
            'billing_type' => $billingType->value,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderDIDInternationalGeographic', $params);
    }

    /**
     * Orders international national DIDs.
     * (Parameters are identical to orderDIDInternationalGeographic)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderDIDInternationalNational(
        string $locationId,
        int $quantity,
        string $routing,
        BillingType $billingType,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'location_id' => $locationId,
            'quantity' => $quantity,
            'routing' => $routing,
            'billing_type' => $billingType->value,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderDIDInternationalNational', $params);
    }

    /**
     * Orders international toll-free DIDs.
     * (BillingType is not applicable for Toll-Free)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderDIDInternationalTollFree(
        string $locationId,
        int $quantity,
        string $routing,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'location_id' => $locationId,
            'quantity' => $quantity,
            'routing' => $routing,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderDIDInternationalTollFree', $params);
    }

    /**
     * Orders virtual DIDs.
     * (BillingType is not applicable for Virtual)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderDIDVirtual(
        int $digits,
        string $routing,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'digits' => $digits,
            'routing' => $routing,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderDIDVirtual', $params);
    }

    /**
     * Orders a toll-free DID.
     * (BillingType is not applicable for Toll-Free)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderTollFree(
        string $didNumber,
        string $routing,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'did' => $didNumber, // API param is 'did'
            'routing' => $routing,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderTollFree', $params);
    }

    /**
     * Orders a vanity DID.
     * (BillingType is not applicable for Vanity)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderVanity(
        string $didNumber,
        string $routing,
        int $carrier,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?string $account = null,
        ?float $monthly = null,
        ?float $setup = null,
        ?float $minute = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'did' => $didNumber, // API param is 'did'
            'routing' => $routing,
            'carrier' => $carrier,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($account !== null) $params['account'] = $account;
        if ($monthly !== null) $params['monthly'] = $monthly;
        if ($setup !== null) $params['setup'] = $setup;
        if ($minute !== null) $params['minute'] = $minute;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderVanity', $params);
    }

    /**
     * Removes a DID from a vPRI client.
     *
     * @param string $didNumber The DID number. API param: did
     * @param int $vpri The vPRI client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function removeDIDvPRI(string $didNumber, int $vpri): array
    {
        $params = [
            'did' => $didNumber,
            'vpri' => $vpri,
        ];
        return $this->post('removeDIDvPRI', $params);
    }

    /**
     * Searches Canadian DIDs.
     *
     * @param string|null $province Optional. Province.
     * @param \VoipMs\V2\Enum\SearchType|null $type Optional. Search type.
     * @param string|null $query Optional. Search query.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchDIDsCAN(?string $province = null, ?\VoipMs\V2\Enum\SearchType $type = null, ?string $query = null): array
    {
        $params = [];
        if ($province !== null) $params['province'] = $province;
        if ($type !== null) $params['type'] = $type->value;
        if ($query !== null) $params['query'] = $query;
        return $this->get('searchDIDsCAN', $params);
    }

    /**
     * Searches USA DIDs.
     *
     * @param string|null $state Optional. State.
     * @param \VoipMs\V2\Enum\SearchType|null $type Optional. Search type.
     * @param string|null $query Optional. Search query.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchDIDsUSA(?string $state = null, ?\VoipMs\V2\Enum\SearchType $type = null, ?string $query = null): array
    {
        $params = [];
        if ($state !== null) $params['state'] = $state;
        if ($type !== null) $params['type'] = $type->value;
        if ($query !== null) $params['query'] = $query;
        return $this->get('searchDIDsUSA', $params);
    }

    /**
     * Searches Canadian/US toll-free DIDs.
     *
     * @param \VoipMs\V2\Enum\SearchType|null $type Optional. Search type.
     * @param string|null $query Optional. Search query.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchTollFreeCanUS(?\VoipMs\V2\Enum\SearchType $type = null, ?string $query = null): array
    {
        $params = [];
        if ($type !== null) $params['type'] = $type->value;
        if ($query !== null) $params['query'] = $query;
        return $this->get('searchTollFreeCanUS', $params);
    }

    /**
     * Searches USA toll-free DIDs. (Note: API documentation might be ambiguous; this could be same as searchTollFreeCanUS)
     *
     * @param \VoipMs\V2\Enum\SearchType|null $type Optional. Search type.
     * @param string|null $query Optional. Search query.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchTollFreeUSA(?\VoipMs\V2\Enum\SearchType $type = null, ?string $query = null): array
    {
        $params = [];
        if ($type !== null) $params['type'] = $type->value;
        if ($query !== null) $params['query'] = $query;
        return $this->get('searchTollFreeUSA', $params);
    }

    /**
     * Searches vanity toll-free DIDs.
     *
     * @param \VoipMs\V2\Enum\VanityTollFreeType $type Vanity search type.
     * @param string $query Search query.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchVanity(\VoipMs\V2\Enum\VanityTollFreeType $type, string $query): array
    {
        $params = [
            'type' => $type->value,
            'query' => $query,
        ];
        return $this->get('searchVanity', $params);
    }

    /**
     * Sends an SMS message.
     *
     * @param string $didNumber Source DID number. API param: did
     * @param string $dst Destination number.
     * @param string $message Message content.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function sendSms(string $didNumber, string $dst, string $message): array
    {
        $params = [
            'did' => $didNumber,
            'dst' => $dst,
            'message' => $message,
        ];
        return $this->post('sendSms', $params);
    }

    /**
     * Sends an MMS message.
     *
     * @param string $didNumber Source DID number. API param: did
     * @param string $dst Destination number.
     * @param string $message Message content.
     * @param string|null $media1 URL for media 1.
     * @param string|null $media2 URL for media 2.
     * @param string|null $media3 URL for media 3.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function sendMms(string $didNumber, string $dst, string $message, ?string $media1 = null, ?string $media2 = null, ?string $media3 = null): array
    {
        $params = [
            'did' => $didNumber,
            'dst' => $dst,
            'message' => $message,
        ];
        if ($media1 !== null) $params['media1'] = $media1;
        if ($media2 !== null) $params['media2'] = $media2;
        if ($media3 !== null) $params['media3'] = $media3;
        return $this->post('sendMms', $params);
    }

    /**
     * Sets callback configuration.
     *
     * @param int|null $callbackId Callback ID to update. API param: callback
     * @param string|null $description Description.
     * @param string|null $number Phone number for callback.
     * @param int|null $delayBefore Delay before callback.
     * @param int|null $responseTimeout Response timeout.
     * @param int|null $digitTimeout Digit timeout.
     * @param string|null $calleridNumber Caller ID number.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setCallback(
        ?int $callbackId = null,
        ?string $description = null,
        ?string $number = null,
        ?int $delayBefore = null,
        ?int $responseTimeout = null,
        ?int $digitTimeout = null,
        ?string $calleridNumber = null
    ): array {
        $params = [];
        if ($callbackId !== null) $params['callback'] = $callbackId;
        if ($description !== null) $params['description'] = $description;
        if ($number !== null) $params['number'] = $number;
        if ($delayBefore !== null) $params['delay_before'] = $delayBefore;
        if ($responseTimeout !== null) $params['response_timeout'] = $responseTimeout;
        if ($digitTimeout !== null) $params['digit_timeout'] = $digitTimeout;
        if ($calleridNumber !== null) $params['callerid_number'] = $calleridNumber;
        return $this->post('setCallback', $params);
    }

    /**
     * Sets caller ID filtering rule.
     *
     * @param int|null $filteringId Filtering ID to update. API param: filter
     * @param string|null $callerid Caller ID to filter.
     * @param string|null $didNumber DID number for the rule. API param: did
     * @param string|null $routing Routing for matched calls.
     * @param string|null $failoverUnreachable Failover for unreachable.
     * @param string|null $failoverBusy Failover for busy.
     * @param string|null $failoverNoanswer Failover for no answer.
     * @param string|null $note Note for the rule.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setCallerIDFiltering(
        ?int $filteringId = null,
        ?string $callerid = null,
        ?string $didNumber = null,
        ?string $routing = null,
        ?string $failoverUnreachable = null,
        ?string $failoverBusy = null,
        ?string $failoverNoanswer = null,
        ?string $note = null
    ): array {
        $params = [];
        if ($filteringId !== null) $params['filter'] = $filteringId;
        if ($callerid !== null) $params['callerid'] = $callerid;
        if ($didNumber !== null) $params['did'] = $didNumber;
        if ($routing !== null) $params['routing'] = $routing;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($note !== null) $params['note'] = $note;
        return $this->post('setCallerIDFiltering', $params);
    }

    /**
     * Sets call hunting configuration.
     *
     * @param int|null $callHuntingId Call hunting ID to update. API param: callhunting
     * @param string|null $description Description.
     * @param string|null $music Music on hold.
     * @param string|null $recording Recording ID.
     * @param \VoipMs\V2\Enum\Language|null $language Language.
     * @param string|null $order Call order.
     * @param string[]|null $members Array of member IDs/numbers. Imploded with ';'.
     * @param string[]|null $ringTime Array of ring times. Imploded with ';'.
     * @param string[]|null $press Array of key press options. Imploded with ';'.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setCallHunting(
        ?int $callHuntingId = null,
        ?string $description = null,
        ?string $music = null,
        ?string $recording = null,
        ?\VoipMs\V2\Enum\Language $language = null,
        ?string $order = null,
        ?array $members = null,
        ?array $ringTime = null,
        ?array $press = null
    ): array {
        $params = [];
        if ($callHuntingId !== null) $params['callhunting'] = $callHuntingId;
        if ($description !== null) $params['description'] = $description;
        if ($music !== null) $params['music'] = $music;
        if ($recording !== null) $params['recording'] = $recording;
        if ($language !== null) $params['language'] = $language->value;
        if ($order !== null) $params['order'] = $order;
        if ($members !== null) $params['members'] = implode(';', $members);
        if ($ringTime !== null) $params['ring_time'] = implode(';', $ringTime);
        if ($press !== null) $params['press'] = implode(';', $press);
        return $this->post('setCallHunting', $params);
    }

    /**
     * Sets DID billing type.
     *
     * @param string $didNumber DID number. API param: did
     * @param BillingType $billingType Billing type.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDIDBillingType(string $didNumber, BillingType $billingType): array
    {
        $params = [
            'did' => $didNumber,
            'billing_type' => $billingType->value,
        ];
        return $this->post('setDIDBillingType', $params);
    }

    /**
     * Sets DID information.
     *
     * @param string $didNumber DID number. API param: did
     * @param string $routing Routing string.
     * @param string|null $failoverBusy Failover for busy.
     * @param string|null $failoverUnreachable Failover for unreachable.
     * @param string|null $failoverNoanswer Failover for no answer.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $pop Point of Presence ID.
     * @param int|null $dialtime Dial time.
     * @param OnOffInteger|null $cnam CNAM enabled/disabled.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $note Note.
     * @param int|null $portOutPin Port out PIN.
     * @param BillingType|null $billingType Billing type.
     * @param OnOffInteger|null $recordCalls Record calls.
     * @param OnOffInteger|null $transcribe Transcribe calls.
     * @param string|null $transcriptionLocale Transcription locale.
     * @param string|null $transcriptionEmail Transcription email.
     * @param int|null $transcriptionStartDelay Transcription start delay.
     * @param int|null $voicemailThreshold Voicemail threshold.
     * @param OnOffInteger|null $smsSipAccountEnabled Enable SMS to SIP account.
     * @param string|null $smsSipAccount SIP account for SMS.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDIDInfo(
        string $didNumber,
        string $routing,
        ?string $failoverBusy = null,
        ?string $failoverUnreachable = null,
        ?string $failoverNoanswer = null,
        ?string $voicemail = null,
        ?int $pop = null,
        ?int $dialtime = null,
        ?OnOffInteger $cnam = null,
        ?string $calleridPrefix = null,
        ?string $note = null,
        ?int $portOutPin = null,
        ?BillingType $billingType = null,
        ?OnOffInteger $recordCalls = null,
        ?OnOffInteger $transcribe = null,
        ?string $transcriptionLocale = null,
        ?string $transcriptionEmail = null,
        ?int $transcriptionStartDelay = null,
        ?int $voicemailThreshold = null,
        ?OnOffInteger $smsSipAccountEnabled = null,
        ?string $smsSipAccount = null
    ): array {
        $params = [
            'did' => $didNumber,
            'routing' => $routing,
        ];
        if ($failoverBusy !== null) $params['failover_busy'] = $failoverBusy;
        if ($failoverUnreachable !== null) $params['failover_unreachable'] = $failoverUnreachable;
        if ($failoverNoanswer !== null) $params['failover_noanswer'] = $failoverNoanswer;
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($pop !== null) $params['pop'] = $pop;
        if ($dialtime !== null) $params['dialtime'] = $dialtime;
        if ($cnam !== null) $params['cnam'] = $cnam->value;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($note !== null) $params['note'] = $note;
        if ($portOutPin !== null) $params['port_out_pin'] = $portOutPin;
        if ($billingType !== null) $params['billing_type'] = $billingType->value;
        if ($recordCalls !== null) $params['record_calls'] = $recordCalls->value;
        if ($transcribe !== null) $params['transcribe'] = $transcribe->value;
        if ($transcriptionLocale !== null) $params['transcription_locale'] = $transcriptionLocale;
        if ($transcriptionEmail !== null) $params['transcription_email'] = $transcriptionEmail;
        if ($transcriptionStartDelay !== null) $params['transcription_start_delay'] = $transcriptionStartDelay;
        if ($voicemailThreshold !== null) $params['voicemail_threshold'] = $voicemailThreshold;
        if ($smsSipAccountEnabled !== null) $params['sms_sip_account_enabled'] = $smsSipAccountEnabled->value;
        if ($smsSipAccount !== null) $params['sms_sip_account'] = $smsSipAccount;
        
        return $this->post('setDIDInfo', $params);
    }

    /**
     * Sets DID POP (Point of Presence).
     *
     * @param string $didNumber DID number. API param: did
     * @param int $pop POP ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDIDPOP(string $didNumber, int $pop): array
    {
        $params = [
            'did' => $didNumber,
            'pop' => $pop,
        ];
        return $this->post('setDIDPOP', $params);
    }

    /**
     * Sets DID routing.
     *
     * @param string $didNumber DID number. API param: did
     * @param string $routing Routing string.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDIDRouting(string $didNumber, string $routing): array
    {
        $params = [
            'did' => $didNumber,
            'routing' => $routing,
        ];
        return $this->post('setDIDRouting', $params);
    }

    /**
     * Sets DID voicemail.
     *
     * @param string $didNumber DID number. API param: did
     * @param string|null $voicemail Voicemail ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDIDVoicemail(string $didNumber, ?string $voicemail = null): array
    {
        $params = ['did' => $didNumber];
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        return $this->post('setDIDVoicemail', $params);
    }

    /**
     * Sets DISA configuration.
     *
     * @param int|null $disaId DISA ID to update. API param: disa
     * @param string|null $name Name.
     * @param int|null $pin PIN.
     * @param int|null $digitTimeout Digit timeout.
     * @param string|null $calleridOverride Caller ID override.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setDISA(
        ?int $disaId = null,
        ?string $name = null,
        ?int $pin = null,
        ?int $digitTimeout = null,
        ?string $calleridOverride = null
    ): array {
        $params = [];
        if ($disaId !== null) $params['disa'] = $disaId;
        if ($name !== null) $params['name'] = $name;
        if ($pin !== null) $params['pin'] = $pin;
        if ($digitTimeout !== null) $params['digit_timeout'] = $digitTimeout;
        if ($calleridOverride !== null) $params['callerid_override'] = $calleridOverride;
        return $this->post('setDISA', $params);
    }

    /**
     * Sets forwarding configuration.
     *
     * @param int|null $forwardingId Forwarding ID to update. API param: forwarding
     * @param string|null $phoneNumber Phone number to forward to.
     * @param string|null $calleridOverride Caller ID override.
     * @param string|null $description Description.
     * @param string|null $dtmfDigits DTMF digits to send.
     * @param float|null $pause Pause before sending DTMF.
     * @param OnOffInteger|null $diversionHeader Use diversion header.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setForwarding(
        ?int $forwardingId = null,
        ?string $phoneNumber = null,
        ?string $calleridOverride = null,
        ?string $description = null,
        ?string $dtmfDigits = null,
        ?float $pause = null,
        ?OnOffInteger $diversionHeader = null
    ): array {
        $params = [];
        if ($forwardingId !== null) $params['forwarding'] = $forwardingId;
        if ($phoneNumber !== null) $params['phone_number'] = $phoneNumber;
        if ($calleridOverride !== null) $params['callerid_override'] = $calleridOverride;
        if ($description !== null) $params['description'] = $description;
        if ($dtmfDigits !== null) $params['dtmf_digits'] = $dtmfDigits;
        if ($pause !== null) $params['pause'] = $pause;
        if ($diversionHeader !== null) $params['diversion_header'] = $diversionHeader->value;
        return $this->post('setForwarding', $params);
    }

    /**
     * Sets IVR configuration.
     *
     * @param int|null $ivrId IVR ID to update. API param: ivr
     * @param string|null $name Name.
     * @param int|null $recordingId Recording ID for announcement.
     * @param int|null $timeout Timeout.
     * @param \VoipMs\V2\Enum\Language|null $language Language.
     * @param VoicemailSetupOption|null $voicemailSetup Voicemail setup option.
     * @param string[]|null $choices Array of IVR choices. Imploded with ';'.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setIVR(
        ?int $ivrId = null,
        ?string $name = null,
        ?int $recordingId = null,
        ?int $timeout = null,
        ?\VoipMs\V2\Enum\Language $language = null,
        ?VoicemailSetupOption $voicemailSetup = null,
        ?array $choices = null
    ): array {
        $params = [];
        if ($ivrId !== null) $params['ivr'] = $ivrId;
        if ($name !== null) $params['name'] = $name;
        if ($recordingId !== null) $params['recording'] = $recordingId;
        if ($timeout !== null) $params['timeout'] = $timeout;
        if ($language !== null) $params['language'] = $language->value;
        if ($voicemailSetup !== null) $params['voicemail_setup'] = $voicemailSetup->value;
        if ($choices !== null) $params['choices'] = implode(';', $choices);
        return $this->post('setIVR', $params);
    }

    /**
     * Sets phonebook entry.
     *
     * @param int|null $phonebookId Phonebook ID to update. API param: phonebook
     * @param string|null $speedDial Speed dial code.
     * @param string|null $name Name.
     * @param string|null $number Phone number.
     * @param string|null $callerid Caller ID.
     * @param string|null $note Note.
     * @param int|null $groupId Group ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setPhonebook(
        ?int $phonebookId = null,
        ?string $speedDial = null,
        ?string $name = null,
        ?string $number = null,
        ?string $callerid = null,
        ?string $note = null,
        ?int $groupId = null
    ): array {
        $params = [];
        if ($phonebookId !== null) $params['phonebook'] = $phonebookId;
        if ($speedDial !== null) $params['speed_dial'] = $speedDial;
        if ($name !== null) $params['name'] = $name;
        if ($number !== null) $params['number'] = $number;
        if ($callerid !== null) $params['callerid'] = $callerid;
        if ($note !== null) $params['note'] = $note;
        if ($groupId !== null) $params['group'] = $groupId;
        return $this->post('setPhonebook', $params);
    }

    /**
     * Sets phonebook group.
     *
     * @param int|null $groupId Group ID to update. API param: group
     * @param string|null $name Group name.
     * @param string[]|null $members Array of member phonebook IDs. Imploded with ';'.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setPhonebookGroup(?int $groupId = null, ?string $name = null, ?array $members = null): array
    {
        $params = [];
        if ($groupId !== null) $params['group'] = $groupId;
        if ($name !== null) $params['name'] = $name;
        if ($members !== null) $params['members'] = implode(';', $members);
        return $this->post('setPhonebookGroup', $params);
    }

    /**
     * Sets queue configuration. This is a very large method with many parameters.
     *
     * @param int|null $queueId Queue ID to update. API param: queue
     * @param string|null $queueName Queue name.
     * @param int|null $queueNumber Queue number.
     * @param \VoipMs\V2\Enum\Language|null $queueLanguage Queue language.
     * @param string|null $queuePassword Queue password.
     * @param string|null $calleridPrefix Caller ID prefix.
     * @param string|null $joinAnnouncement Join announcement recording ID.
     * @param int|null $priorityWeight Priority weight.
     * @param string|null $agentAnnouncement Agent announcement recording ID.
     * @param \VoipMs\V2\Enum\ReportEstimateHoldTimeType|null $reportHoldTimeAgent Report hold time to agent.
     * @param string|null $memberDelay Member delay.
     * @param string|null $maximumWaitTime Maximum wait time.
     * @param string|null $maximumCallers Maximum callers.
     * @param JoinWhenEmptyType|null $joinWhenEmpty Join when empty strategy.
     * @param \VoipMs\V2\Enum\LeaveWhenEmptyType|null $leaveWhenEmpty Leave when empty strategy.
     * @param RingStrategy|null $ringStrategy Ring strategy.
     * @param YesNo|null $ringInuse Ring in-use.
     * @param int|null $agentRingTimeout Agent ring timeout.
     * @param string|null $retryTimer Retry timer.
     * @param string|null $wrapupTime Wrap-up time.
     * @param string|null $voiceAnnouncement Voice announcement recording ID.
     * @param string|null $frequencyAnnouncement Frequency announcement.
     * @param string|null $announcePositionFrecuency Announce position frequency. API typo: frecuency
     * @param string|null $announceRoundSeconds Announce round seconds.
     * @param \VoipMs\V2\Enum\ReportEstimateHoldTimeType|null $ifAnnouncePositionEnabledReportEstimatedHoldTime Report hold time if position announce enabled.
     * @param YesNo|null $thankyouForYourPatience Thank you for your patience message.
     * @param string|null $musicOnHold Music on hold.
     * @param string|null $failOverRoutingTimeout Failover routing for timeout.
     * @param string|null $failOverRoutingFull Failover routing for full queue.
     * @param string|null $failOverRoutingJoinEmpty Failover routing for join empty.
     * @param string|null $failOverRoutingLeaveEmpty Failover routing for leave empty.
     * @param string|null $failOverRoutingJoinUnavail Failover routing for join unavailable.
     * @param string|null $failOverRoutingLeaveUnavail Failover routing for leave unavailable.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setQueue(
        ?int $queueId = null,
        ?string $queueName = null,
        ?int $queueNumber = null,
        ?\VoipMs\V2\Enum\Language $queueLanguage = null,
        ?string $queuePassword = null,
        ?string $calleridPrefix = null,
        ?string $joinAnnouncement = null,
        ?int $priorityWeight = null,
        ?string $agentAnnouncement = null,
        ?\VoipMs\V2\Enum\ReportEstimateHoldTimeType $reportHoldTimeAgent = null,
        ?string $memberDelay = null,
        ?string $maximumWaitTime = null,
        ?string $maximumCallers = null,
        ?JoinWhenEmptyType $joinWhenEmpty = null,
        ?\VoipMs\V2\Enum\LeaveWhenEmptyType $leaveWhenEmpty = null,
        ?RingStrategy $ringStrategy = null,
        ?YesNo $ringInuse = null,
        ?int $agentRingTimeout = null,
        ?string $retryTimer = null,
        ?string $wrapupTime = null,
        ?string $voiceAnnouncement = null,
        ?string $frequencyAnnouncement = null,
        ?string $announcePositionFrecuency = null, // API typo
        ?string $announceRoundSeconds = null,
        ?\VoipMs\V2\Enum\ReportEstimateHoldTimeType $ifAnnouncePositionEnabledReportEstimatedHoldTime = null,
        ?YesNo $thankyouForYourPatience = null,
        ?string $musicOnHold = null,
        ?string $failOverRoutingTimeout = null,
        ?string $failOverRoutingFull = null,
        ?string $failOverRoutingJoinEmpty = null,
        ?string $failOverRoutingLeaveEmpty = null,
        ?string $failOverRoutingJoinUnavail = null,
        ?string $failOverRoutingLeaveUnavail = null
    ): array {
        $params = [];
        if ($queueId !== null) $params['queue'] = $queueId;
        if ($queueName !== null) $params['queue_name'] = $queueName;
        if ($queueNumber !== null) $params['queue_number'] = $queueNumber;
        if ($queueLanguage !== null) $params['queue_language'] = $queueLanguage->value;
        if ($queuePassword !== null) $params['queue_password'] = $queuePassword;
        if ($calleridPrefix !== null) $params['callerid_prefix'] = $calleridPrefix;
        if ($joinAnnouncement !== null) $params['join_announcement'] = $joinAnnouncement;
        if ($priorityWeight !== null) $params['priority_weight'] = $priorityWeight;
        if ($agentAnnouncement !== null) $params['agent_announcement'] = $agentAnnouncement;
        if ($reportHoldTimeAgent !== null) $params['report_hold_time_agent'] = $reportHoldTimeAgent->value;
        if ($memberDelay !== null) $params['member_delay'] = $memberDelay;
        if ($maximumWaitTime !== null) $params['maximum_wait_time'] = $maximumWaitTime;
        if ($maximumCallers !== null) $params['maximum_callers'] = $maximumCallers;
        if ($joinWhenEmpty !== null) $params['join_when_empty'] = $joinWhenEmpty->value;
        if ($leaveWhenEmpty !== null) $params['leave_when_empty'] = $leaveWhenEmpty->value;
        if ($ringStrategy !== null) $params['ring_strategy'] = $ringStrategy->value;
        if ($ringInuse !== null) $params['ring_inuse'] = $ringInuse->value;
        if ($agentRingTimeout !== null) $params['agent_ring_timeout'] = $agentRingTimeout;
        if ($retryTimer !== null) $params['retry_timer'] = $retryTimer;
        if ($wrapupTime !== null) $params['wrapup_time'] = $wrapupTime;
        if ($voiceAnnouncement !== null) $params['voice_announcement'] = $voiceAnnouncement;
        if ($frequencyAnnouncement !== null) $params['frequency_announcement'] = $frequencyAnnouncement;
        if ($announcePositionFrecuency !== null) $params['announce_position_frecuency'] = $announcePositionFrecuency; // API typo
        if ($announceRoundSeconds !== null) $params['announce_round_seconds'] = $announceRoundSeconds;
        if ($ifAnnouncePositionEnabledReportEstimatedHoldTime !== null) $params['if_announce_position_enabled_report_estimated_hold_time'] = $ifAnnouncePositionEnabledReportEstimatedHoldTime->value;
        if ($thankyouForYourPatience !== null) $params['thankyou_for_your_patience'] = $thankyouForYourPatience->value;
        if ($musicOnHold !== null) $params['music_on_hold'] = $musicOnHold;
        if ($failOverRoutingTimeout !== null) $params['fail_over_routing_timeout'] = $failOverRoutingTimeout;
        if ($failOverRoutingFull !== null) $params['fail_over_routing_full'] = $failOverRoutingFull;
        if ($failOverRoutingJoinEmpty !== null) $params['fail_over_routing_join_empty'] = $failOverRoutingJoinEmpty;
        if ($failOverRoutingLeaveEmpty !== null) $params['fail_over_routing_leave_empty'] = $failOverRoutingLeaveEmpty;
        if ($failOverRoutingJoinUnavail !== null) $params['fail_over_routing_join_unavail'] = $failOverRoutingJoinUnavail;
        if ($failOverRoutingLeaveUnavail !== null) $params['fail_over_routing_leave_unavail'] = $failOverRoutingLeaveUnavail;

        return $this->post('setQueue', $params);
    }

    /**
     * Sets recording (uploads or updates).
     *
     * @param int|null $recordingId Recording ID to update. API param: recording
     * @param string|null $fileBase64 Base64 encoded file content. API param: file
     * @param string|null $name Name of the recording.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setRecording(?int $recordingId = null, ?string $fileBase64 = null, ?string $name = null): array
    {
        $params = [];
        if ($recordingId !== null) $params['recording'] = $recordingId;
        if ($fileBase64 !== null) $params['file'] = $fileBase64;
        if ($name !== null) $params['name'] = $name;
        return $this->post('setRecording', $params);
    }

    /**
     * Sets ring group configuration.
     *
     * @param int|null $ringGroupId Ring group ID to update. API param: ring_group
     * @param string|null $name Name.
     * @param string[]|null $members Array of member routing strings. Imploded with ';'.
     * @param string|null $voicemail Voicemail ID.
     * @param int|null $callerAnnouncementId Caller announcement recording ID. API param: caller_announcement
     * @param string|null $musicOnHold Music on hold.
     * @param \VoipMs\V2\Enum\Language|null $language Language.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setRingGroup(
        ?int $ringGroupId = null,
        ?string $name = null,
        ?array $members = null,
        ?string $voicemail = null,
        ?int $callerAnnouncementId = null,
        ?string $musicOnHold = null,
        ?\VoipMs\V2\Enum\Language $language = null
    ): array {
        $params = [];
        if ($ringGroupId !== null) $params['ring_group'] = $ringGroupId;
        if ($name !== null) $params['name'] = $name;
        if ($members !== null) $params['members'] = implode(';', $members);
        if ($voicemail !== null) $params['voicemail'] = $voicemail;
        if ($callerAnnouncementId !== null) $params['caller_announcement'] = $callerAnnouncementId;
        if ($musicOnHold !== null) $params['music_on_hold'] = $musicOnHold;
        if ($language !== null) $params['language'] = $language->value;
        return $this->post('setRingGroup', $params);
    }

    /**
     * Sets SIP URI configuration.
     *
     * @param int|null $sipUriId SIP URI ID to update. API param: sipuri
     * @param string|null $uri SIP URI.
     * @param string|null $description Description.
     * @param string|null $calleridOverride Caller ID override.
     * @param OnOffInteger|null $calleridE164 Use E164 format for caller ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setSIPURI(
        ?int $sipUriId = null,
        ?string $uri = null,
        ?string $description = null,
        ?string $calleridOverride = null,
        ?OnOffInteger $calleridE164 = null
    ): array {
        $params = [];
        if ($sipUriId !== null) $params['sipuri'] = $sipUriId;
        if ($uri !== null) $params['uri'] = $uri;
        if ($description !== null) $params['description'] = $description;
        if ($calleridOverride !== null) $params['callerid_override'] = $calleridOverride;
        if ($calleridE164 !== null) $params['callerid_e164'] = $calleridE164->value;
        return $this->post('setSIPURI', $params);
    }

    /**
     * Sets SMS configuration for a DID.
     *
     * @param string $didNumber DID number. API param: did
     * @param OnOffInteger $enable Enable/disable SMS.
     * @param OnOffInteger|null $emailEnabled Enable email forwarding.
     * @param string|null $emailAddress Email address for forwarding.
     * @param OnOffInteger|null $smsForwardEnable Enable SMS forwarding.
     * @param string|null $smsForward Phone number for SMS forwarding.
     * @param OnOffInteger|null $urlCallbackEnable Enable URL callback.
     * @param string|null $urlCallback URL for callback.
     * @param OnOffInteger|null $urlCallbackRetry Enable URL callback retry.
     * @param OnOffInteger|null $webhookEnable Enable webhook.
     * @param string|null $webhook Webhook URL.
     * @param \VoipMs\V2\Enum\DialingModeOption|null $dialmode Dialing mode.
     * @param OnOffInteger|null $smppEnabled Enable SMPP.
     * @param string|null $smppUrl SMPP URL.
     * @param string|null $smppUser SMPP user.
     * @param string|null $smppPass SMPP password.
     * @param OnOffInteger|null $smsSipAccountEnabled Enable SMS to SIP account.
     * @param string|null $smsSipAccount SIP account for SMS.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setSMS(
        string $didNumber,
        OnOffInteger $enable,
        ?OnOffInteger $emailEnabled = null,
        ?string $emailAddress = null,
        ?OnOffInteger $smsForwardEnable = null,
        ?string $smsForward = null,
        ?OnOffInteger $urlCallbackEnable = null,
        ?string $urlCallback = null,
        ?OnOffInteger $urlCallbackRetry = null,
        ?OnOffInteger $webhookEnable = null,
        ?string $webhook = null,
        ?\VoipMs\V2\Enum\DialingModeOption $dialmode = null,
        ?OnOffInteger $smppEnabled = null,
        ?string $smppUrl = null,
        ?string $smppUser = null,
        ?string $smppPass = null,
        ?OnOffInteger $smsSipAccountEnabled = null,
        ?string $smsSipAccount = null
    ): array {
        $params = [
            'did' => $didNumber,
            'enable' => $enable->value,
        ];
        if ($emailEnabled !== null) $params['email_enabled'] = $emailEnabled->value;
        if ($emailAddress !== null) $params['email_address'] = $emailAddress;
        if ($smsForwardEnable !== null) $params['sms_forward_enable'] = $smsForwardEnable->value;
        if ($smsForward !== null) $params['sms_forward'] = $smsForward;
        if ($urlCallbackEnable !== null) $params['url_callback_enable'] = $urlCallbackEnable->value;
        if ($urlCallback !== null) $params['url_callback'] = $urlCallback;
        if ($urlCallbackRetry !== null) $params['url_callback_retry'] = $urlCallbackRetry->value;
        if ($webhookEnable !== null) $params['webhook_enable'] = $webhookEnable->value;
        if ($webhook !== null) $params['webhook'] = $webhook;
        if ($dialmode !== null) $params['dialmode'] = $dialmode->value;
        if ($smppEnabled !== null) $params['smpp_enabled'] = $smppEnabled->value;
        if ($smppUrl !== null) $params['smpp_url'] = $smppUrl;
        if ($smppUser !== null) $params['smpp_user'] = $smppUser;
        if ($smppPass !== null) $params['smpp_pass'] = $smppPass;
        if ($smsSipAccountEnabled !== null) $params['sms_sip_account_enabled'] = $smsSipAccountEnabled->value;
        if ($smsSipAccount !== null) $params['sms_sip_account'] = $smsSipAccount;
        
        return $this->post('setSMS', $params);
    }

    /**
     * Sets static member for a queue.
     *
     * @param int|null $memberId Member ID to update. API param: member
     * @param int|null $queueId Queue ID. API param: queue
     * @param string|null $memberName Member name.
     * @param string|null $account Account for the member.
     * @param int|null $priority Priority.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setStaticMember(
        ?int $memberId = null,
        ?int $queueId = null,
        ?string $memberName = null,
        ?string $account = null,
        ?int $priority = null
    ): array {
        $params = [];
        if ($memberId !== null) $params['member'] = $memberId;
        if ($queueId !== null) $params['queue'] = $queueId;
        if ($memberName !== null) $params['member_name'] = $memberName;
        if ($account !== null) $params['account'] = $account;
        if ($priority !== null) $params['priority'] = $priority;
        return $this->post('setStaticMember', $params);
    }

    /**
     * Sets time condition.
     *
     * @param int|null $timeConditionId Time condition ID to update. API param: timecondition
     * @param string|null $name Name.
     * @param string|null $routingMatch Routing for match.
     * @param string|null $routingNomatch Routing for no match.
     * @param string[]|null $startHour Array of start hours. Imploded with ';'.
     * @param string[]|null $startMinute Array of start minutes. Imploded with ';'.
     * @param string[]|null $endHour Array of end hours. Imploded with ';'.
     * @param string[]|null $endMinute Array of end minutes. Imploded with ';'.
     * @param string[]|null $weekdayStart Array of start weekdays. Imploded with ';'.
     * @param string[]|null $weekdayEnd Array of end weekdays. Imploded with ';'.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setTimeCondition(
        ?int $timeConditionId = null,
        ?string $name = null,
        ?string $routingMatch = null,
        ?string $routingNomatch = null,
        ?array $startHour = null,
        ?array $startMinute = null,
        ?array $endHour = null,
        ?array $endMinute = null,
        ?array $weekdayStart = null,
        ?array $weekdayEnd = null
    ): array {
        $params = [];
        if ($timeConditionId !== null) $params['timecondition'] = $timeConditionId;
        if ($name !== null) $params['name'] = $name;
        if ($routingMatch !== null) $params['routing_match'] = $routingMatch;
        if ($routingNomatch !== null) $params['routing_nomatch'] = $routingNomatch;
        if ($startHour !== null) $params['start_hour'] = implode(';', $startHour);
        if ($startMinute !== null) $params['start_minute'] = implode(';', $startMinute);
        if ($endHour !== null) $params['end_hour'] = implode(';', $endHour);
        if ($endMinute !== null) $params['end_minute'] = implode(';', $endMinute);
        if ($weekdayStart !== null) $params['weekday_start'] = implode(';', $weekdayStart);
        if ($weekdayEnd !== null) $params['weekday_end'] = implode(';', $weekdayEnd);
        return $this->post('setTimeCondition', $params);
    }

    /**
     * Unconnects a DID from a client account.
     *
     * @param string $didNumber DID number. API param: did
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function unconnectDID(string $didNumber): array
    {
        $params = ['did' => $didNumber];
        return $this->post('unconnectDID', $params);
    }
}
