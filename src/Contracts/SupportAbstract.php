<?php

namespace Softcomtecnologia\SoftsendClient\Contracts;

use GuzzleHttp\Stream\Stream;
use Softcomtecnologia\Api\Grant\SoftcomCredentials;
use Softcomtecnologia\Api\Provider\SoftcomProvider;
use Softcomtecnologia\Api\Token\SoftcomAccessToken;
use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;

abstract class SupportAbstract implements SupportInterface
{
    /**
     * @var string
     */
    protected $responseType = SoftsendConfigs::RESPONSE_TYPE_RAW;

    /**
     * @var array
     */
    protected $responsesAvailables = [
        SoftsendConfigs::RESPONSE_TYPE_ARRAY,
        SoftsendConfigs::RESPONSE_TYPE_OBJECT,
        SoftsendConfigs::RESPONSE_TYPE_RAW,
    ];

    /**
     * @var array
     */
    protected $optionsProvider = [
        'domain' => SoftsendConfigs::URL_DOMAIN,
    ];

    /**
     * @var SoftcomProvider
     */
    protected $provider;

    /**
     * @var SoftcomAccessToken
     */
    protected $token;

    /**
     * @var bool
     */
    protected $debugMode = false;


    /**
     * @param array $optionsProvider
     */
    public function __construct(array $optionsProvider = [])
    {
        if ($optionsProvider) {
            $this->optionsProvider = $optionsProvider;
        }

        $this->provider = new SoftcomProvider($this->optionsProvider);
    }


    /**
     * @param $response
     *
     * @return mixed
     */
    public function prepareResponse($response)
    {
        if ($this->responseType == SoftsendConfigs::RESPONSE_TYPE_RAW) {
            return $response instanceof Stream
                ? $response->getContents()
                : $response;
        }

        return json_decode($response, $this->responseType == SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    }


    /**
     * @param $type
     *
     * @return $this
     * @throws \Exception
     */
    public function responseType($type)
    {
        if (in_array($type, $this->responsesAvailables)) {
            $this->responseType = $type;

            return $this;
        }

        throw new \Exception("The type `$type` is not valid");
    }


    /**
     * @return SoftcomAccessToken
     * @throws \League\OAuth2\Client\Exception\IDPException
     */
    public function getToken()
    {
        if (is_string($this->token)) {
            $this->token = new SoftcomAccessToken(['access_token' => $this->token]);
        }

        if (!$this->token instanceof SoftcomAccessToken) {
            $this->token = $this->provider->getAccessToken(new SoftcomCredentials());
        }

        return $this->token;
    }


    /**
     * @param $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }


    /**
     * @return bool
     */
    public function getDebugMode()
    {
        return $this->debugMode;
    }


    /**
     * @param bool $debugMode
     *
     * @return $this
     */
    public function setDebugMode($debugMode)
    {
        $this->debugMode = (bool) $debugMode;

        return $this;
    }


    /**
     * @return mixed
     */
    protected function responseToDebugMode()
    {
        $info = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];
        $response = json_encode([
            'debug_mode'    => $this->getDebugMode(),
            'message'       => 'Method executed in Debug Mode.',
            'class'         => $info['class'] . '::' . $info['function'] . '()',
        ]);

        if ($this->responseType == SoftsendConfigs::RESPONSE_TYPE_RAW) {
            return $response;
        }

        return json_decode($response, $this->responseType == SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    }
}
