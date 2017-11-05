<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class StoreClient extends SupportAbstract
{
    /**
     * @var string
     */
    protected $clientCnpj;

    /**
     * @var string
     */
    protected $name;


    /**
     * @param string $clientCnpj
     * @param string $name
     * @param array  $optionsProvider
     */
    public function __construct($clientCnpj, $name, array $optionsProvider = [])
    {
        $this->clientCnpj = $clientCnpj;
        $this->name = $name;

        parent::__construct($optionsProvider);
    }


    public function support()
    {
        $response = $this->provider->post(
            '',
            SoftsendConfigs::URL_STORE_CLIENT,
            ['client_cnpj' => $this->clientCnpj, 'name' => $this->name]
        );

        return $this->prepareResponse($response);
    }
}
