<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\YesNo;
use VoipMs\V2\Enum\PlayInstructionsOption;
use VoipMs\V2\Enum\Language;
use VoipMs\V2\Enum\EmailAttachmentFormat;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'Voicemail' API methods.
 */
class Voicemail extends AbstractApi
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
     * Creates a new voicemail.
     *
     * @param int $digits Voicemail number/digits.
     * @param string $name Name for the voicemail.
     * @param string $password Password for the voicemail.
     * @param YesNo $skipPassword Skip password prompt.
     * @param YesNo $attachMessage Attach message to email.
     * @param YesNo $deleteMessage Delete message after emailing.
     * @param YesNo $sayTime Announce time of message.
     * @param string $timezone Timezone for the voicemail.
     * @param YesNo $sayCallerid Announce caller ID.
     * @param PlayInstructionsOption $playInstructions Instructions to play.
     * @param Language $language Language for prompts.
     * @param string|null $email Optional. Email address for notifications.
     * @param EmailAttachmentFormat|null $emailAttachmentFormat Optional. Email attachment format.
     * @param string|null $unavailableMessageRecording Optional. Unavailable message recording ID.
     * @param string|null $transcription Optional. Enable transcription (e.g., 'yes', 'no', or specific service).
     * @param string|null $transcriptionLocale Optional. Locale for transcription.
     * @param int|null $clientId Optional. Client ID for reseller.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function createVoicemail(
        int $digits,
        string $name,
        string $password,
        YesNo $skipPassword,
        YesNo $attachMessage,
        YesNo $deleteMessage,
        YesNo $sayTime,
        string $timezone,
        YesNo $sayCallerid,
        PlayInstructionsOption $playInstructions,
        Language $language,
        ?string $email = null,
        ?EmailAttachmentFormat $emailAttachmentFormat = null,
        ?string $unavailableMessageRecording = null,
        ?string $transcription = null, // Typically 'yes'/'no' or a service identifier
        ?string $transcriptionLocale = null,
        ?int $clientId = null
    ): array {
        $params = [
            'digits' => $digits,
            'name' => $name,
            'password' => $password,
            'skip_password' => $skipPassword->value,
            'attach_message' => $attachMessage->value,
            'delete_message' => $deleteMessage->value,
            'say_time' => $sayTime->value,
            'timezone' => $timezone,
            'say_callerid' => $sayCallerid->value,
            'play_instructions' => $playInstructions->value,
            'language' => $language->value,
        ];
        if ($email !== null) $params['email'] = $email;
        if ($emailAttachmentFormat !== null) $params['email_attachment_format'] = $emailAttachmentFormat->value;
        if ($unavailableMessageRecording !== null) $params['unavailable_message_recording'] = $unavailableMessageRecording;
        if ($transcription !== null) $params['transcription'] = $transcription;
        if ($transcriptionLocale !== null) $params['transcription_locale'] = $transcriptionLocale;
        if ($clientId !== null) $params['client'] = $clientId;

        return $this->post('createVoicemail', $params);
    }

    /**
     * Deletes messages from a voicemail box.
     *
     * @param int $mailbox The voicemail box ID.
     * @param string|null $folder Optional. Folder name (e.g., 'INBOX', 'Old'). Defaults to 'INBOX'.
     * @param int|null $messageNum Optional. Specific message number to delete. If null, all messages in folder are deleted.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delMessages(int $mailbox, ?string $folder = null, ?int $messageNum = null): array
    {
        $params = ['mailbox' => $mailbox];
        if ($folder !== null) $params['folder'] = $folder;
        if ($messageNum !== null) $params['message_num'] = $messageNum;
        return $this->post('delMessages', $params);
    }

    /**
     * Deletes a member from a conference.
     * Note: Categorized under Voicemail per issue description, though functionally related to Conferences.
     *
     * @param int $memberId The ID of the conference member to delete.
     * @param int $conferenceId The ID of the conference.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delMemberFromConference(int $memberId, int $conferenceId): array
    {
        $params = [
            'member' => $memberId,
            'conference' => $conferenceId,
        ];
        return $this->post('delMemberFromConference', $params);
    }

    /**
     * Deletes a voicemail box.
     *
     * @param int $mailbox The voicemail box ID to delete.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delVoicemail(int $mailbox): array
    {
        $params = ['mailbox' => $mailbox];
        return $this->post('delVoicemail', $params);
    }

    /**
     * Retrieves play instructions options for voicemail.
     *
     * @param PlayInstructionsOption|null $playInstructions Optional. Specific play instructions option to retrieve.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getPlayInstructions(?PlayInstructionsOption $playInstructions = null): array
    {
        $params = [];
        if ($playInstructions !== null) {
            $params['play_instructions'] = $playInstructions->value;
        }
        return $this->get('getPlayInstructions', $params);
    }

    /**
     * Retrieves available timezones.
     *
     * @param string|null $timezone Optional. Specific timezone to retrieve information for.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getTimezones(?string $timezone = null): array
    {
        $params = [];
        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }
        return $this->get('getTimezones', $params);
    }

    /**
     * Retrieves voicemail boxes.
     *
     * @param int|null $mailbox Optional. Specific voicemail box ID to retrieve.
     * @param int|null $clientId Optional. Client ID for reseller.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemails(?int $mailbox = null, ?int $clientId = null): array
    {
        $params = [];
        if ($mailbox !== null) $params['mailbox'] = $mailbox;
        if ($clientId !== null) $params['client'] = $clientId;
        return $this->get('getVoicemails', $params);
    }

    /**
     * Retrieves folders for a voicemail box.
     *
     * @param int|null $mailbox Optional. Specific voicemail box ID.
     * @param string|null $folderName Optional. Specific folder name.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemailFolders(?int $mailbox = null, ?string $folderName = null): array
    {
        $params = [];
        if ($mailbox !== null) $params['mailbox'] = $mailbox;
        if ($folderName !== null) $params['folder'] = $folderName;
        return $this->get('getVoicemailFolders', $params);
    }

    /**
     * Retrieves a voicemail message file.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string $folder Folder name.
     * @param int $messageNum Message number.
     * @param string|null $format Optional. Format of the file ('mp3', 'wav', 'wav49', 'gsm'). Defaults to 'mp3'.
     * @return array Decoded JSON response (likely contains base64 file or URL).
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemailMessageFile(int $mailbox, string $folder, int $messageNum, ?string $format = null): array
    {
        $params = [
            'mailbox' => $mailbox,
            'folder' => $folder,
            'message_num' => $messageNum,
        ];
        if ($format !== null) $params['format'] = $format;
        return $this->get('getVoicemailMessageFile', $params);
    }

    /**
     * Retrieves messages from a voicemail box.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string|null $folder Optional. Folder name (e.g., 'INBOX', 'Old'). Defaults to 'INBOX'.
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD).
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD).
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVoicemailMessages(int $mailbox, ?string $folder = null, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $params = ['mailbox' => $mailbox];
        if ($folder !== null) $params['folder'] = $folder;
        if ($dateFrom !== null) $params['date_from'] = $dateFrom;
        if ($dateTo !== null) $params['date_to'] = $dateTo;
        return $this->get('getVoicemailMessages', $params);
    }

    /**
     * Retrieves vPRI configurations.
     *
     * @param int|null $vpriId Optional. Specific vPRI ID.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getVPRIs(?int $vpriId = null): array
    {
        $params = [];
        if ($vpriId !== null) $params['vpri'] = $vpriId;
        return $this->get('getVPRIs', $params);
    }

    /**
     * Marks a voicemail message as listened/unlistened.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string $folder Folder name.
     * @param int $messageNum Message number.
     * @param YesNo $listened Set to YesNo::YES for listened, YesNo::NO for unlistened.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function markListenedVoicemailMessage(int $mailbox, string $folder, int $messageNum, YesNo $listened): array
    {
        $params = [
            'mailbox' => $mailbox,
            'folder' => $folder,
            'message_num' => $messageNum,
            'listened' => $listened->value,
        ];
        return $this->post('markListenedVoicemailMessage', $params);
    }

    /**
     * Marks a voicemail message as urgent/not urgent.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string $folder Folder name.
     * @param int $messageNum Message number.
     * @param YesNo $urgent Set to YesNo::YES for urgent, YesNo::NO for not urgent.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function markUrgentVoicemailMessage(int $mailbox, string $folder, int $messageNum, YesNo $urgent): array
    {
        $params = [
            'mailbox' => $mailbox,
            'folder' => $folder,
            'message_num' => $messageNum,
            'urgent' => $urgent->value,
        ];
        return $this->post('markUrgentVoicemailMessage', $params);
    }

    /**
     * Moves a voicemail message to a different folder.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string $folder Current folder name.
     * @param int $messageNum Message number.
     * @param string $newFolder Destination folder name.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function moveFolderVoicemailMessage(int $mailbox, string $folder, int $messageNum, string $newFolder): array
    {
        $params = [
            'mailbox' => $mailbox,
            'folder' => $folder,
            'message_num' => $messageNum,
            'new_folder' => $newFolder,
        ];
        return $this->post('moveFolderVoicemailMessage', $params);
    }

    /**
     * Sends a voicemail message to an email address.
     *
     * @param int $mailbox Voicemail box ID.
     * @param string $folder Folder name.
     * @param int $messageNum Message number.
     * @param string $emailAddress Email address to send to.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function sendVoicemailEmail(int $mailbox, string $folder, int $messageNum, string $emailAddress): array
    {
        $params = [
            'mailbox' => $mailbox,
            'folder' => $folder,
            'message_num' => $messageNum,
            'email_address' => $emailAddress,
        ];
        return $this->post('sendVoicemailEmail', $params);
    }

    /**
     * Sets (updates) voicemail configuration.
     * (Parameters are identical to createVoicemail, except 'digits' is not present, 'mailbox' is used for ID)
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setVoicemail(
        int $mailbox, // This is the ID of the voicemail to update
        string $name,
        string $password,
        YesNo $skipPassword,
        YesNo $attachMessage,
        YesNo $deleteMessage,
        YesNo $sayTime,
        string $timezone,
        YesNo $sayCallerid,
        PlayInstructionsOption $playInstructions,
        Language $language,
        ?string $email = null,
        ?EmailAttachmentFormat $emailAttachmentFormat = null,
        ?string $unavailableMessageRecording = null,
        ?string $transcription = null,
        ?string $transcriptionLocale = null,
        ?int $clientId = null
    ): array {
        $params = [
            'mailbox' => $mailbox,
            'name' => $name,
            'password' => $password,
            'skip_password' => $skipPassword->value,
            'attach_message' => $attachMessage->value,
            'delete_message' => $deleteMessage->value,
            'say_time' => $sayTime->value,
            'timezone' => $timezone,
            'say_callerid' => $sayCallerid->value,
            'play_instructions' => $playInstructions->value,
            'language' => $language->value,
        ];
        if ($email !== null) $params['email'] = $email;
        if ($emailAttachmentFormat !== null) $params['email_attachment_format'] = $emailAttachmentFormat->value;
        if ($unavailableMessageRecording !== null) $params['unavailable_message_recording'] = $unavailableMessageRecording;
        if ($transcription !== null) $params['transcription'] = $transcription;
        if ($transcriptionLocale !== null) $params['transcription_locale'] = $transcriptionLocale;
        if ($clientId !== null) $params['client'] = $clientId;

        return $this->post('setVoicemail', $params);
    }
}
