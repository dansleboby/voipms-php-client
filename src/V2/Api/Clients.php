<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\YesNo;
use VoipMs\V2\Enum\CountryOption;
use VoipMs\V2\Enum\BalanceManagementOption;
use VoipMs\V2\Enum\OnOffInteger;
use VoipMs\V2\Enum\Language;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'Clients' API methods.
 */
class Clients extends AbstractApi
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
     * Adds a charge to a client's account.
     *
     * @param int $client Client ID.
     * @param float $charge Amount to charge.
     * @param string|null $description Optional. Description for the charge.
     * @param YesNo|null $test Optional. Set to YesNo::YES for testing (no actual charge).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function addCharge(int $client, float $charge, ?string $description = null, ?YesNo $test = null): array
    {
        $params = [
            'client' => $client,
            'charge' => $charge,
        ];
        if ($description !== null) $params['description'] = $description;
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('addCharge', $params);
    }

    /**
     * Adds a payment to a client's account.
     *
     * @param int $client Client ID.
     * @param float $payment Amount of payment.
     * @param string|null $description Optional. Description for the payment.
     * @param YesNo|null $test Optional. Set to YesNo::YES for testing (no actual payment).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function addPayment(int $client, float $payment, ?string $description = null, ?YesNo $test = null): array
    {
        $params = [
            'client' => $client,
            'payment' => $payment,
        ];
        if ($description !== null) $params['description'] = $description;
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('addPayment', $params);
    }

    /**
     * Assigns a DID vPRI to a client.
     *
     * @param string $did The DID number.
     * @param int $vpri The vPRI client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function assignDIDvPRI(string $did, int $vpri): array
    {
        $params = [
            'did' => $did,
            'vpri' => $vpri,
        ];
        return $this->post('assignDIDvPRI', $params);
    }

    /**
     * Retrieves balance management options.
     *
     * @param string|null $code Optional. Specific balance management code to retrieve.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getBalanceManagement(?string $code = null): array
    {
        $params = [];
        if ($code !== null) {
            $params['balance_management'] = $code;
        }
        return $this->get('getBalanceManagement', $params);
    }

    /**
     * Retrieves charges for a specific client.
     *
     * @param int $client Client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getCharges(int $client): array
    {
        $params = ['client' => $client];
        return $this->get('getCharges', $params);
    }

    /**
     * Retrieves packages assigned to a specific client.
     *
     * @param int $client Client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getClientPackages(int $client): array
    {
        $params = ['client' => $client];
        return $this->get('getClientPackages', $params);
    }

    /**
     * Retrieves clients or information about a specific client.
     *
     * @param string|null $clientEmailOrId Optional. Client email or ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getClients(?string $clientEmailOrId = null): array
    {
        $params = [];
        if ($clientEmailOrId !== null) {
            $params['client'] = $clientEmailOrId;
        }
        return $this->get('getClients', $params);
    }

    /**
     * Retrieves the threshold for a specific client.
     *
     * @param int $client Client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getClientThreshold(int $client): array
    {
        $params = ['client' => $client];
        return $this->get('getClientThreshold', $params);
    }

    /**
     * Retrieves deposits for a specific client.
     *
     * @param int $client Client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getDeposits(int $client): array
    {
        $params = ['client' => $client];
        return $this->get('getDeposits', $params);
    }

    /**
     * Retrieves packages or information about a specific package.
     *
     * @param string|null $packageCode Optional. Package code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getPackages(?string $packageCode = null): array
    {
        $params = [];
        if ($packageCode !== null) {
            $params['package'] = $packageCode;
        }
        return $this->get('getPackages', $params);
    }

    /**
     * Retrieves the balance for a specific reseller client.
     *
     * @param int $client Client ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getResellerBalance(int $client): array
    {
        $params = ['client' => $client];
        return $this->get('getResellerBalance', $params);
    }

    /**
     * Sets (updates) client information.
     *
     * @param int $clientId Client ID.
     * @param string $email Client's email.
     * @param string $password Client's password.
     * @param string $firstName Client's first name.
     * @param string $lastName Client's last name.
     * @param string $phoneNumber Client's phone number.
     * @param string|null $company Optional. Client's company name.
     * @param string|null $address Optional. Client's address.
     * @param string|null $city Optional. Client's city.
     * @param string|null $state Optional. Client's state/province.
     * @param CountryOption|null $country Optional. Client's country.
     * @param string|null $zip Optional. Client's ZIP/postal code.
     * @param BalanceManagementOption|null $balanceManagement Optional. Balance management option.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setClient(
        int $clientId,
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        string $phoneNumber,
        ?string $company = null,
        ?string $address = null,
        ?string $city = null,
        ?string $state = null,
        ?CountryOption $country = null,
        ?string $zip = null,
        ?BalanceManagementOption $balanceManagement = null
    ): array {
        $params = [
            'client' => $clientId, // API parameter is 'client'
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone_number' => $phoneNumber,
        ];
        if ($company !== null) $params['company'] = $company;
        if ($address !== null) $params['address'] = $address;
        if ($city !== null) $params['city'] = $city;
        if ($state !== null) $params['state'] = $state;
        if ($country !== null) $params['country'] = $country->value;
        if ($zip !== null) $params['zip'] = $zip;
        if ($balanceManagement !== null) $params['balance_management'] = $balanceManagement->value;

        return $this->post('setClient', $params);
    }

    /**
     * Sets the threshold for a specific client.
     *
     * @param int $client Client ID.
     * @param int $threshold Threshold value.
     * @param string|null $email Optional. Email for notifications.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setClientThreshold(int $client, int $threshold, ?string $email = null): array
    {
        $params = [
            'client' => $client,
            'threshold' => $threshold,
        ];
        if ($email !== null) $params['email'] = $email;
        return $this->post('setClientThreshold', $params);
    }

    /**
     * Sets (creates or updates) a conference.
     * Sound parameters are recording IDs (string '0' for default, or actual ID).
     *
     * @param string $name Conference name.
     * @param string $description Conference description.
     * @param int $maxMembers Maximum members.
     * @param int|null $conferenceId Optional. Conference ID to update.
     * @param string[]|null $members Optional. Array of member IDs.
     * @param string|null $soundJoin Optional. Sound when joining.
     * @param string|null $soundLeave Optional. Sound when leaving.
     * @param string|null $soundHasJoined Optional. Sound when someone has joined.
     * @param string|null $soundHasLeft Optional. Sound when someone has left.
     * @param string|null $soundKicked Optional. Sound when kicked.
     * @param string|null $soundMuted Optional. Sound when muted.
     * @param string|null $soundUnmuted Optional. Sound when unmuted.
     * @param string|null $soundOnlyPerson Optional. Sound for only person.
     * @param string|null $soundOnlyOne Optional. Sound for only one.
     * @param string|null $soundThereAre Optional. Sound "there are".
     * @param string|null $soundOtherInParty Optional. Sound "other in party".
     * @param string|null $soundPlaceIntoConference Optional. Sound "place into conference".
     * @param string|null $soundGetPin Optional. Sound "get pin".
     * @param string|null $soundInvalidPin Optional. Sound "invalid pin".
     * @param string|null $soundLocked Optional. Sound "locked".
     * @param string|null $soundLockedNow Optional. Sound "locked now".
     * @param string|null $soundUnlockedNow Optional. Sound "unlocked now".
     * @param string|null $soundErrorMenu Optional. Sound "error menu".
     * @param string|null $soundParticipantsMuted Optional. Sound "participants muted".
     * @param string|null $soundParticipantsUnmuted Optional. Sound "participants unmuted".
     * @param Language|null $language Optional. Language for announcements.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setConference(
        string $name,
        string $description,
        int $maxMembers,
        ?int $conferenceId = null,
        ?array $members = null,
        ?string $soundJoin = null,
        ?string $soundLeave = null,
        ?string $soundHasJoined = null,
        ?string $soundHasLeft = null,
        ?string $soundKicked = null,
        ?string $soundMuted = null,
        ?string $soundUnmuted = null,
        ?string $soundOnlyPerson = null,
        ?string $soundOnlyOne = null,
        ?string $soundThereAre = null,
        ?string $soundOtherInParty = null,
        ?string $soundPlaceIntoConference = null,
        ?string $soundGetPin = null,
        ?string $soundInvalidPin = null,
        ?string $soundLocked = null,
        ?string $soundLockedNow = null,
        ?string $soundUnlockedNow = null,
        ?string $soundErrorMenu = null,
        ?string $soundParticipantsMuted = null,
        ?string $soundParticipantsUnmuted = null,
        ?Language $language = null
    ): array {
        $params = [
            'name' => $name,
            'description' => $description,
            'max_members' => $maxMembers,
        ];
        if ($conferenceId !== null) $params['conference'] = $conferenceId; // API param is 'conference'
        if ($members !== null) $params['members'] = implode(';', $members);
        if ($soundJoin !== null) $params['sound_join'] = $soundJoin;
        if ($soundLeave !== null) $params['sound_leave'] = $soundLeave;
        if ($soundHasJoined !== null) $params['sound_has_joined'] = $soundHasJoined;
        if ($soundHasLeft !== null) $params['sound_has_left'] = $soundHasLeft;
        if ($soundKicked !== null) $params['sound_kicked'] = $soundKicked;
        if ($soundMuted !== null) $params['sound_muted'] = $soundMuted;
        if ($soundUnmuted !== null) $params['sound_unmuted'] = $soundUnmuted;
        if ($soundOnlyPerson !== null) $params['sound_only_person'] = $soundOnlyPerson;
        if ($soundOnlyOne !== null) $params['sound_only_one'] = $soundOnlyOne;
        if ($soundThereAre !== null) $params['sound_there_are'] = $soundThereAre;
        if ($soundOtherInParty !== null) $params['sound_other_in_party'] = $soundOtherInParty;
        if ($soundPlaceIntoConference !== null) $params['sound_place_into_conference'] = $soundPlaceIntoConference;
        if ($soundGetPin !== null) $params['sound_get_pin'] = $soundGetPin;
        if ($soundInvalidPin !== null) $params['sound_invalid_pin'] = $soundInvalidPin;
        if ($soundLocked !== null) $params['sound_locked'] = $soundLocked;
        if ($soundLockedNow !== null) $params['sound_locked_now'] = $soundLockedNow;
        if ($soundUnlockedNow !== null) $params['sound_unlocked_now'] = $soundUnlockedNow;
        if ($soundErrorMenu !== null) $params['sound_error_menu'] = $soundErrorMenu;
        if ($soundParticipantsMuted !== null) $params['sound_participants_muted'] = $soundParticipantsMuted;
        if ($soundParticipantsUnmuted !== null) $params['sound_participants_unmuted'] = $soundParticipantsUnmuted;
        if ($language !== null) $params['language'] = $language->value;

        return $this->post('setConference', $params);
    }

    /**
     * Sets (creates or updates) a conference member.
     *
     * @param int $conferenceId Conference ID.
     * @param string $name Member's name.
     * @param int|null $memberId Optional. Member ID to update.
     * @param string|null $description Optional. Member's description.
     * @param int|null $pin Optional. Member's PIN.
     * @param YesNo|null $announceJoinLeave Optional. Announce join/leave.
     * @param YesNo|null $admin Optional. Is admin.
     * @param YesNo|null $startMuted Optional. Start muted.
     * @param YesNo|null $announceUserCount Optional. Announce user count.
     * @param YesNo|null $announceOnlyUser Optional. Announce only user.
     * @param string|null $mohWhenEmpty Optional. Music on Hold when empty (recording ID or '0').
     * @param YesNo|null $quiet Optional. Quiet mode.
     * @param int|null $announcement Optional. Announcement ID.
     * @param YesNo|null $dropSilence Optional. Drop silence.
     * @param int|null $talkingThreshold Optional. Talking threshold.
     * @param int|null $silenceThreshold Optional. Silence threshold.
     * @param YesNo|null $talkDetection Optional. Talk detection.
     * @param YesNo|null $jitterBuffer Optional. Jitter buffer.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setConferenceMember(
        int $conferenceId,
        string $name,
        ?int $memberId = null,
        ?string $description = null,
        ?int $pin = null,
        ?YesNo $announceJoinLeave = null,
        ?YesNo $admin = null,
        ?YesNo $startMuted = null,
        ?YesNo $announceUserCount = null,
        ?YesNo $announceOnlyUser = null,
        ?string $mohWhenEmpty = null,
        ?YesNo $quiet = null,
        ?int $announcement = null,
        ?YesNo $dropSilence = null,
        ?int $talkingThreshold = null,
        ?int $silenceThreshold = null,
        ?YesNo $talkDetection = null,
        ?YesNo $jitterBuffer = null
    ): array {
        $params = [
            'conference' => $conferenceId, // API param is 'conference'
            'name' => $name,
        ];
        if ($memberId !== null) $params['member'] = $memberId; // API param is 'member'
        if ($description !== null) $params['description'] = $description;
        if ($pin !== null) $params['pin'] = $pin;
        if ($announceJoinLeave !== null) $params['announce_join_leave'] = $announceJoinLeave->value;
        if ($admin !== null) $params['admin'] = $admin->value;
        if ($startMuted !== null) $params['start_muted'] = $startMuted->value;
        if ($announceUserCount !== null) $params['announce_user_count'] = $announceUserCount->value;
        if ($announceOnlyUser !== null) $params['announce_only_user'] = $announceOnlyUser->value;
        if ($mohWhenEmpty !== null) $params['moh_when_empty'] = $mohWhenEmpty;
        if ($quiet !== null) $params['quiet'] = $quiet->value;
        if ($announcement !== null) $params['announcement'] = $announcement;
        if ($dropSilence !== null) $params['drop_silence'] = $dropSilence->value;
        if ($talkingThreshold !== null) $params['talking_threshold'] = $talkingThreshold;
        if ($silenceThreshold !== null) $params['silence_threshold'] = $silenceThreshold;
        if ($talkDetection !== null) $params['talk_detection'] = $talkDetection->value;
        if ($jitterBuffer !== null) $params['jitter_buffer'] = $jitterBuffer->value;

        return $this->post('setConferenceMember', $params);
    }

    /**
     * Sets (creates or updates) sequences.
     *
     * @param string $name Sequence name.
     * @param string $stepsJson JSON string representing the sequence steps.
     * @param int|null $sequenceId Optional. Sequence ID to update.
     * @param int|null $clientId Optional. Client ID for reseller.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setSequences(string $name, string $stepsJson, ?int $sequenceId = null, ?int $clientId = null): array
    {
        $params = [
            'name' => $name,
            'steps_json' => $stepsJson,
        ];
        if ($sequenceId !== null) $params['sequence'] = $sequenceId; // API param is 'sequence'
        if ($clientId !== null) $params['client'] = $clientId; // API param is 'client'
        return $this->post('setSequences', $params);
    }

    /**
     * Signs up a new client.
     *
     * @param string $firstName Client's first name.
     * @param string $lastName Client's last name.
     * @param string $address Client's address.
     * @param string $city Client's city.
     * @param string $state Client's state/province.
     * @param CountryOption $country Client's country.
     * @param string $zip Client's ZIP/postal code.
     * @param string $phoneNumber Client's phone number.
     * @param string $email Client's email.
     * @param string $confirmEmail Confirmation of client's email.
     * @param string $password Client's password.
     * @param string $confirmPassword Confirmation of client's password.
     * @param string|null $company Optional. Client's company name.
     * @param OnOffInteger|null $activate Optional. Activate client immediately.
     * @param BalanceManagementOption|null $balanceManagement Optional. Balance management option.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function signupClient(
        string $firstName,
        string $lastName,
        string $address,
        string $city,
        string $state,
        CountryOption $country,
        string $zip,
        string $phoneNumber,
        string $email,
        string $confirmEmail,
        string $password,
        string $confirmPassword,
        ?string $company = null,
        ?OnOffInteger $activate = null,
        ?BalanceManagementOption $balanceManagement = null
    ): array {
        $params = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'country' => $country->value,
            'zip' => $zip,
            'phone_number' => $phoneNumber,
            'email' => $email,
            'confirm_email' => $confirmEmail,
            'password' => $password,
            'confirm_password' => $confirmPassword,
        ];
        if ($company !== null) $params['company'] = $company;
        if ($activate !== null) $params['activate'] = $activate->value;
        if ($balanceManagement !== null) $params['balance_management'] = $balanceManagement->value;

        return $this->post('signupClient', $params);
    }
}
