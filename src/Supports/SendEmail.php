<?php

namespace Softcomtecnologia\SoftsendClient\Supports;


use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class SendEmail extends SupportAbstract
{

    /**
     * @param array  $data
     * @param string $clientId
     * @param string $clientSecret
     * @param string $domain
     */
    public function __construct(array $data = [], $clientId = '', $clientSecret = '', $domain = '')
    {
        $optionsProvider = get_defined_vars();

        if (!$optionsProvider['domain']) {
            $optionsProvider['domain'] = SoftsendConfigs::URL_DOMAIN;
        }

        parent::__construct($optionsProvider);
    }


    public function support()
    {
        try {
            $response = $this->provider->post(
                $this->getToken(),
                SoftsendConfigs::URL_SEND_EMAIL,
                $this->optionsProvider
            );
        } catch (InvalidResponseException $e) {
            $response = $e->getRequestParamsFromString();
        }

        return $this->prepareResponse($response);
    }

}
