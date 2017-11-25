<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class AutenticationClient extends SupportAbstract
{

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $domain
     */
    public function __construct($clientId = '', $clientSecret = '', $domain = '')
    {
        $optionsProvider = get_defined_vars();

        if (!$optionsProvider['domain']) {
            $optionsProvider['domain'] = SoftsendConfigs::URL_DOMAIN;
        }

        parent::__construct($optionsProvider);
    }


    /**
     * @return mixed
     */
    public function support()
    {
        try {
            $response = $this->provider->post(
                $this->getToken(),
                SoftsendConfigs::URL_AUTENTICATION_CLIENT,
                $this->optionsProvider
            );
        } catch(InvalidResponseException $e) {
            $response = $e->getRequestParamsFromString();
        }

        return $this->prepareResponse($response);
    }

}