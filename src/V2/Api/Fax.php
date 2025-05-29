<?php

namespace VoipMs\V2\Api;

use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Enum\YesNo;
use VoipMs\V2\Enum\OnOffInteger;
use VoipMs\V2\Exception\HttpException;
use VoipMs\V2\Exception\JsonException;

/**
 * Handles 'Fax' API methods.
 */
class Fax extends AbstractApi
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
     * Connects a FAX DID to a client account.
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
    public function connectFAX(
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

        return $this->post('connectFAX', $params);
    }

    /**
     * Unconnects a FAX DID from a client account.
     *
     * @param string $did The DID number to unconnect.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function unconnectFAX(string $did): array
    {
        $params = ['did' => $did];
        return $this->post('unconnectFAX', $params);
    }

    /**
     * Cancels a Fax Number.
     *
     * @param int $faxId The ID of the fax number to cancel. API param: id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function cancelFaxNumber(int $faxId, ?YesNo $test = null): array
    {
        $params = ['id' => $faxId];
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('cancelFaxNumber', $params);
    }

    /**
     * Deletes a Fax Message.
     *
     * @param int $faxMessageId The ID of the fax message to delete. API param: id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function deleteFaxMessage(int $faxMessageId, ?YesNo $test = null): array
    {
        $params = ['id' => $faxMessageId];
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('deleteFaxMessage', $params);
    }

    /**
     * Deletes an Email to Fax configuration.
     *
     * @param int $emailToFaxId The ID of the Email to Fax configuration to delete. API param: id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delEmailToFax(int $emailToFaxId, ?YesNo $test = null): array
    {
        $params = ['id' => $emailToFaxId];
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('delEmailToFax', $params);
    }

    /**
     * Deletes a Fax Folder.
     *
     * @param int $folderId The ID of the folder to delete. API param: id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function delFaxFolder(int $folderId, ?YesNo $test = null): array
    {
        $params = ['id' => $folderId];
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('delFaxFolder', $params);
    }

    /**
     * Retrieves Fax Back Orders.
     *
     * @param string|null $backOrderId Optional. Specific Back Order ID. API param: id
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getBackOrders(?string $backOrderId = null): array
    {
        $params = [];
        if ($backOrderId !== null) $params['id'] = $backOrderId;
        return $this->get('getBackOrders', $params);
    }

    /**
     * Retrieves Fax Provinces.
     *
     * @param string|null $provinceCode Optional. Specific province code. API param: province
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxProvinces(?string $provinceCode = null): array
    {
        $params = [];
        if ($provinceCode !== null) $params['province'] = $provinceCode;
        return $this->get('getFaxProvinces', $params);
    }

    /**
     * Retrieves Fax States.
     *
     * @param string|null $stateCode Optional. Specific state code. API param: state
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxStates(?string $stateCode = null): array
    {
        $params = [];
        if ($stateCode !== null) $params['state'] = $stateCode;
        return $this->get('getFaxStates', $params);
    }

    /**
     * Retrieves Fax Rate Centers for Canada.
     *
     * @param string $province Province code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxRateCentersCAN(string $province): array
    {
        $params = ['province' => $province];
        return $this->get('getFaxRateCentersCAN', $params);
    }

    /**
     * Retrieves Fax Rate Centers for USA.
     *
     * @param string $state State code.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxRateCentersUSA(string $state): array
    {
        $params = ['state' => $state];
        return $this->get('getFaxRateCentersUSA', $params);
    }

    /**
     * Retrieves information for Fax Numbers.
     *
     * @param int|null $did Optional. Specific DID number. API param: did
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxNumbersInfo(?int $did = null): array
    {
        $params = [];
        if ($did !== null) $params['did'] = $did;
        return $this->get('getFaxNumbersInfo', $params);
    }

    /**
     * Retrieves portability information for Fax Numbers.
     *
     * @param int $did The DID number. API param: did
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxNumbersPortability(int $did): array
    {
        $params = ['did' => $did];
        return $this->get('getFaxNumbersPortability', $params);
    }

    /**
     * Retrieves Fax Messages.
     *
     * @param string|null $dateFrom Optional. Start date (YYYY-MM-DD). API param: from
     * @param string|null $dateTo Optional. End date (YYYY-MM-DD). API param: to
     * @param string|null $folderName Optional. Folder name. API param: folder
     * @param int|null $faxMessageId Optional. Specific Fax Message ID. API param: id
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxMessages(?string $dateFrom = null, ?string $dateTo = null, ?string $folderName = null, ?int $faxMessageId = null): array
    {
        $params = [];
        if ($dateFrom !== null) $params['from'] = $dateFrom;
        if ($dateTo !== null) $params['to'] = $dateTo;
        if ($folderName !== null) $params['folder'] = $folderName;
        if ($faxMessageId !== null) $params['id'] = $faxMessageId;
        return $this->get('getFaxMessages', $params);
    }

    /**
     * Retrieves a Fax Message PDF.
     *
     * @param int $faxMessageId The ID of the fax message. API param: id
     * @return array Decoded JSON response (likely contains base64 PDF or URL).
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxMessagePDF(int $faxMessageId): array
    {
        $params = ['id' => $faxMessageId];
        return $this->get('getFaxMessagePDF', $params);
    }

    /**
     * Retrieves Fax Folders.
     *
     * @param int|null $folderId Optional. Specific Folder ID. API param: id
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getFaxFolders(?int $folderId = null): array
    {
        $params = [];
        if ($folderId !== null) $params['id'] = $folderId;
        return $this->get('getFaxFolders', $params);
    }

    /**
     * Retrieves Email to Fax configurations.
     *
     * @param int|null $emailToFaxId Optional. Specific Email to Fax ID. API param: id
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function getEmailToFax(?int $emailToFaxId = null): array
    {
        $params = [];
        if ($emailToFaxId !== null) $params['id'] = $emailToFaxId;
        return $this->get('getEmailToFax', $params);
    }

    /**
     * Mails a Fax Message PDF.
     *
     * @param int $faxMessageId The ID of the fax message. API param: id
     * @param string $email The email address to send the PDF to.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function mailFaxMessagePDF(int $faxMessageId, string $email): array
    {
        $params = [
            'id' => $faxMessageId,
            'email' => $email,
        ];
        return $this->post('mailFaxMessagePDF', $params);
    }

    /**
     * Moves a Fax Message to a different folder.
     *
     * @param int $faxId The ID of the fax message. API param: fax_id
     * @param int $folderId The ID of the destination folder. API param: folder_id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function moveFaxMessage(int $faxId, int $folderId, ?YesNo $test = null): array
    {
        $params = [
            'fax_id' => $faxId,
            'folder_id' => $folderId,
        ];
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('moveFaxMessage', $params);
    }

    /**
     * Orders a Fax Number.
     *
     * @param int $location Location ID.
     * @param int $quantity Quantity of numbers to order.
     * @param string|null $email Optional. Email for notifications.
     * @param OnOffInteger|null $emailEnable Optional. Enable email notifications.
     * @param OnOffInteger|null $emailAttachFile Optional. Attach fax file to email.
     * @param string|null $urlCallback Optional. URL for callback.
     * @param OnOffInteger|null $urlCallbackEnable Optional. Enable URL callback.
     * @param OnOffInteger|null $urlCallbackRetry Optional. Enable URL callback retry.
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function orderFaxNumber(
        int $location,
        int $quantity,
        ?string $email = null,
        ?OnOffInteger $emailEnable = null,
        ?OnOffInteger $emailAttachFile = null,
        ?string $urlCallback = null,
        ?OnOffInteger $urlCallbackEnable = null,
        ?OnOffInteger $urlCallbackRetry = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'location' => $location,
            'quantity' => $quantity,
        ];
        if ($email !== null) $params['email'] = $email;
        if ($emailEnable !== null) $params['email_enable'] = $emailEnable->value;
        if ($emailAttachFile !== null) $params['email_attach_file'] = $emailAttachFile->value;
        if ($urlCallback !== null) $params['url_callback'] = $urlCallback;
        if ($urlCallbackEnable !== null) $params['url_callback_enable'] = $urlCallbackEnable->value;
        if ($urlCallbackRetry !== null) $params['url_callback_retry'] = $urlCallbackRetry->value;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('orderFaxNumber', $params);
    }

    /**
     * Sets (creates or updates) a Fax Folder.
     *
     * @param string $name Name of the folder.
     * @param int|null $folderId Optional. Folder ID to update. API param: id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setFaxFolder(string $name, ?int $folderId = null, ?YesNo $test = null): array
    {
        $params = ['name' => $name];
        if ($folderId !== null) $params['id'] = $folderId;
        if ($test !== null) $params['test'] = $test->value;
        return $this->post('setFaxFolder', $params);
    }

    /**
     * Sets (creates or updates) an Email to Fax configuration.
     *
     * @param string $authEmail Authorized email address. API param: auth_email
     * @param string $fromNumberId DID/Fax number to use as sender ID. API param: from_number_id
     * @param int|null $emailToFaxId Optional. Email to Fax ID to update. API param: id
     * @param OnOffInteger|null $enabled Optional. Enable/disable this configuration.
     * @param OnOffInteger|null $securityCodeEnabled Optional. Enable security code.
     * @param string|null $securityCode Optional. Security code.
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setEmailToFax(
        string $authEmail,
        string $fromNumberId,
        ?int $emailToFaxId = null,
        ?OnOffInteger $enabled = null,
        ?OnOffInteger $securityCodeEnabled = null,
        ?string $securityCode = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'auth_email' => $authEmail,
            'from_number_id' => $fromNumberId,
        ];
        if ($emailToFaxId !== null) $params['id'] = $emailToFaxId;
        if ($enabled !== null) $params['enabled'] = $enabled->value;
        if ($securityCodeEnabled !== null) $params['security_code_enabled'] = $securityCodeEnabled->value;
        if ($securityCode !== null) $params['security_code'] = $securityCode;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('setEmailToFax', $params);
    }

    /**
     * Searches Fax Area Codes for Canada.
     *
     * @param int $areaCode The area code to search. API param: area_code
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchFaxAreaCodeCAN(int $areaCode): array
    {
        $params = ['area_code' => $areaCode];
        return $this->get('searchFaxAreaCodeCAN', $params);
    }

    /**
     * Searches Fax Area Codes for USA.
     *
     * @param int $areaCode The area code to search. API param: area_code
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function searchFaxAreaCodeUSA(int $areaCode): array
    {
        $params = ['area_code' => $areaCode];
        return $this->get('searchFaxAreaCodeUSA', $params);
    }

    /**
     * Sets information for a Fax Number.
     *
     * @param int $did The DID number. API param: did
     * @param string|null $email Optional. Email for notifications.
     * @param OnOffInteger|null $emailEnable Optional. Enable email notifications.
     * @param OnOffInteger|null $emailAttachFile Optional. Attach fax file to email.
     * @param string|null $urlCallback Optional. URL for callback.
     * @param OnOffInteger|null $urlCallbackEnable Optional. Enable URL callback.
     * @param OnOffInteger|null $urlCallbackRetry Optional. Enable URL callback retry.
     * @param OnOffInteger|null $faxToSipEnabled Optional. Enable Fax to SIP.
     * @param string|null $faxToSipAccount Optional. SIP account for Fax to SIP.
     * @param string|null $note Optional. Note.
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setFaxNumberInfo(
        int $did,
        ?string $email = null,
        ?OnOffInteger $emailEnable = null,
        ?OnOffInteger $emailAttachFile = null,
        ?string $urlCallback = null,
        ?OnOffInteger $urlCallbackEnable = null,
        ?OnOffInteger $urlCallbackRetry = null,
        ?OnOffInteger $faxToSipEnabled = null,
        ?string $faxToSipAccount = null,
        ?string $note = null,
        ?YesNo $test = null
    ): array {
        $params = ['did' => $did];
        if ($email !== null) $params['email'] = $email;
        if ($emailEnable !== null) $params['email_enable'] = $emailEnable->value;
        if ($emailAttachFile !== null) $params['email_attach_file'] = $emailAttachFile->value;
        if ($urlCallback !== null) $params['url_callback'] = $urlCallback;
        if ($urlCallbackEnable !== null) $params['url_callback_enable'] = $urlCallbackEnable->value;
        if ($urlCallbackRetry !== null) $params['url_callback_retry'] = $urlCallbackRetry->value;
        if ($faxToSipEnabled !== null) $params['fax_to_sip_enabled'] = $faxToSipEnabled->value;
        if ($faxToSipAccount !== null) $params['fax_to_sip_account'] = $faxToSipAccount;
        if ($note !== null) $params['note'] = $note;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('setFaxNumberInfo', $params);
    }

    /**
     * Sets email notification settings for a Fax Number.
     *
     * @param int $did The DID number. API param: did
     * @param string|null $email Optional. Email for notifications.
     * @param OnOffInteger|null $emailEnable Optional. Enable email notifications.
     * @param OnOffInteger|null $emailAttachFile Optional. Attach fax file to email.
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setFaxNumberEmail(
        int $did,
        ?string $email = null,
        ?OnOffInteger $emailEnable = null,
        ?OnOffInteger $emailAttachFile = null,
        ?YesNo $test = null
    ): array {
        $params = ['did' => $did];
        if ($email !== null) $params['email'] = $email;
        if ($emailEnable !== null) $params['email_enable'] = $emailEnable->value;
        if ($emailAttachFile !== null) $params['email_attach_file'] = $emailAttachFile->value;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('setFaxNumberEmail', $params);
    }

    /**
     * Sets URL callback settings for a Fax Number.
     *
     * @param int $did The DID number. API param: did
     * @param string|null $urlCallback Optional. URL for callback.
     * @param OnOffInteger|null $urlCallbackEnable Optional. Enable URL callback.
     * @param OnOffInteger|null $urlCallbackRetry Optional. Enable URL callback retry.
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function setFaxNumberURLCallback(
        int $did,
        ?string $urlCallback = null,
        ?OnOffInteger $urlCallbackEnable = null,
        ?OnOffInteger $urlCallbackRetry = null,
        ?YesNo $test = null
    ): array {
        $params = ['did' => $did];
        if ($urlCallback !== null) $params['url_callback'] = $urlCallback;
        if ($urlCallbackEnable !== null) $params['url_callback_enable'] = $urlCallbackEnable->value;
        if ($urlCallbackRetry !== null) $params['url_callback_retry'] = $urlCallbackRetry->value;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('setFaxNumberURLCallback', $params);
    }

    /**
     * Sends a Fax Message.
     *
     * @param string $toNumber Destination fax number. API param: to_number
     * @param string $fromName Sender's name. API param: from_name
     * @param string $fromNumber Sender's fax number. API param: from_number
     * @param string $fileBase64 Base64 encoded file content. API param: file
     * @param OnOffInteger|null $sendEmailEnabled Optional. Enable email notification of send status. API param: send_email_enabled
     * @param string|null $sendEmail Optional. Email address for send status notification. API param: send_email
     * @param string|null $stationId Optional. Station ID for the fax. API param: station_id
     * @param YesNo|null $test Optional. Test mode.
     * @return array Decoded JSON response.
     * @throws HttpException If the API request fails.
     * @throws JsonException If the API response cannot be decoded.
     */
    public function sendFaxMessage(
        string $toNumber,
        string $fromName,
        string $fromNumber,
        string $fileBase64,
        ?OnOffInteger $sendEmailEnabled = null,
        ?string $sendEmail = null,
        ?string $stationId = null,
        ?YesNo $test = null
    ): array {
        $params = [
            'to_number' => $toNumber,
            'from_name' => $fromName,
            'from_number' => $fromNumber,
            'file' => $fileBase64,
        ];
        if ($sendEmailEnabled !== null) $params['send_email_enabled'] = $sendEmailEnabled->value;
        if ($sendEmail !== null) $params['send_email'] = $sendEmail;
        if ($stationId !== null) $params['station_id'] = $stationId;
        if ($test !== null) $params['test'] = $test->value;

        return $this->post('sendFaxMessage', $params);
    }
}
