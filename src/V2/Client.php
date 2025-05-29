<?php

namespace VoipMs\V2;

use GuzzleHttp\Client as GuzzlePHPClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use VoipMs\V2\Http\HttpClient;
use VoipMs\V2\Api;

/**
 * Main client for interacting with the Voip.ms API v2.
 */
class Client
{
    private HttpClient $httpClient;
    private string $apiUsername;
    private string $apiPassword;

    private ?Api\Accounts $accountsApi = null;
    private ?Api\CallParking $callParkingApi = null;
    private ?Api\CallRecordings $callRecordingsApi = null;
    private ?Api\Cdrs $cdrsApi = null;
    private ?Api\Clients $clientsApi = null;
    private ?Api\Dids $didsApi = null;
    private ?Api\E911 $e911Api = null;
    private ?Api\Fax $faxApi = null;
    private ?Api\General $generalApi = null;
    private ?Api\Lnp $lnpApi = null;
    private ?Api\Voicemail $voicemailApi = null;

    /**
     * Constructor for the Voip.ms API Client.
     *
     * @param string $apiUsername Your Voip.ms API username.
     * @param string $apiPassword Your Voip.ms API password.
     * @param LoggerInterface|null $logger Optional PSR-3 logger instance.
     * @param GuzzleClientInterface|null $guzzleClient Optional Guzzle HTTP client instance.
     * @param int $timeout Optional timeout for HTTP requests in seconds.
     * @param int $maxRetries Optional maximum number of retries for failed requests.
     */
    public function __construct(
        string $apiUsername,
        string $apiPassword,
        ?LoggerInterface $logger = null,
        ?GuzzleClientInterface $guzzleClient = null,
        int $timeout = 30,
        int $maxRetries = 3
    ) {
        $this->apiUsername = $apiUsername;
        $this->apiPassword = $apiPassword;

        $_logger = $logger ?? new NullLogger();
        $_guzzleClient = $guzzleClient ?? new GuzzlePHPClient(['timeout' => $timeout]);

        $this->httpClient = new HttpClient($_guzzleClient, $_logger, $timeout, $maxRetries);
    }

    /**
     * Access the Accounts API methods.
     * @return Api\Accounts
     */
    public function accounts(): Api\Accounts
    {
        if ($this->accountsApi === null) {
            $this->accountsApi = new Api\Accounts($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->accountsApi;
    }

    /**
     * Access the CallParking API methods.
     * @return Api\CallParking
     */
    public function callParking(): Api\CallParking
    {
        if ($this->callParkingApi === null) {
            $this->callParkingApi = new Api\CallParking($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->callParkingApi;
    }

    /**
     * Access the CallRecordings API methods.
     * @return Api\CallRecordings
     */
    public function callRecordings(): Api\CallRecordings
    {
        if ($this->callRecordingsApi === null) {
            $this->callRecordingsApi = new Api\CallRecordings($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->callRecordingsApi;
    }

    /**
     * Access the CDRs (Call Detail Records) API methods.
     * @return Api\Cdrs
     */
    public function cdrs(): Api\Cdrs
    {
        if ($this->cdrsApi === null) {
            $this->cdrsApi = new Api\Cdrs($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->cdrsApi;
    }

    /**
     * Access the Clients API methods.
     * @return Api\Clients
     */
    public function clients(): Api\Clients
    {
        if ($this->clientsApi === null) {
            $this->clientsApi = new Api\Clients($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->clientsApi;
    }

    /**
     * Access the DIDs (Direct Inward Dialing) API methods.
     * @return Api\Dids
     */
    public function dids(): Api\Dids
    {
        if ($this->didsApi === null) {
            $this->didsApi = new Api\Dids($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->didsApi;
    }

    /**
     * Access the E911 API methods.
     * @return Api\E911
     */
    public function e911(): Api\E911
    {
        if ($this->e911Api === null) {
            $this->e911Api = new Api\E911($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->e911Api;
    }

    /**
     * Access the Fax API methods.
     * @return Api\Fax
     */
    public function fax(): Api\Fax
    {
        if ($this->faxApi === null) {
            $this->faxApi = new Api\Fax($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->faxApi;
    }

    /**
     * Access the General API methods.
     * @return Api\General
     */
    public function general(): Api\General
    {
        if ($this->generalApi === null) {
            $this->generalApi = new Api\General($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->generalApi;
    }

    /**
     * Access the LNP (Local Number Portability) API methods.
     * @return Api\Lnp
     */
    public function lnp(): Api\Lnp
    {
        if ($this->lnpApi === null) {
            $this->lnpApi = new Api\Lnp($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->lnpApi;
    }

    /**
     * Access the Voicemail API methods.
     * @return Api\Voicemail
     */
    public function voicemail(): Api\Voicemail
    {
        if ($this->voicemailApi === null) {
            $this->voicemailApi = new Api\Voicemail($this->httpClient, $this->apiUsername, $this->apiPassword);
        }
        return $this->voicemailApi;
    }
}
