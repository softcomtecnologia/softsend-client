<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class GetTypeSms extends SupportAbstract
{

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $domain
     */
    public function __construct($clientId = '', $clientSecret = '', $domain = SoftsendConfigs::URL_DOMAIN)
    {
        parent::__construct(get_defined_vars());
    }


    /**
     * @return mixed
     */
    public function support()
    {
        try {
            $response = $this->provider->get(
                $this->getToken(),
                SoftsendConfigs::URL_TYPE_SMS,
                $this->optionsProvider
            );
        } catch (InvalidResponseException $e) {
            $response = $e->getRequestParamsFromString();
        }

        return $this->prepareResponse($response);
    }

}

