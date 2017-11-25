<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class StoreClient extends SupportAbstract
{

    /**
     * @param array  $optionsProvider
     */
    public function __construct(array $optionsProvider = [])
    {
        if (!isset($optionsProvider['domain'])) {
            $optionsProvider['domain'] = SoftsendConfigs::URL_DOMAIN;
        }

        parent::__construct($optionsProvider);
    }


    public function support()
    {
        $response = $this->provider->post(
            '',
            SoftsendConfigs::URL_STORE_CLIENT,
            $this->optionsProvider
        );

        return $this->prepareResponse($response);
    }
}
