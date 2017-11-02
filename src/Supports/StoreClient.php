<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\Api\Provider\SoftcomProvider;
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
     * @var SoftcomProvider
     */
    protected $provider;

    /**
     * @var array
     */
    protected $optionsProvider = [
        'domain' => SoftsendConfigs::URL_DOMAIN,
    ];


    /**
     * @param string $clientCnpj
     * @param string $name
     * @param array  $optionsProvider
     */
    public function __construct($clientCnpj, $name, array $optionsProvider = [])
    {
        $this->clientCnpj = $clientCnpj;
        $this->name = $name;

        if ($optionsProvider) {
            $this->optionsProvider = $optionsProvider;
        }

        $this->provider = new SoftcomProvider($this->optionsProvider);
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
