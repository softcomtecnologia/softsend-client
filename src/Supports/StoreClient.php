<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\Api\Provider\SoftcomProvider;
use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\SoftsendClient\Contracts\SupportInterface;

class StoreClient implements SupportInterface
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
     * @var bool
     */
    protected $responseJson = true;


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

        return json_decode($response, $this->responseJson);
    }


    /**
     * @param $bool
     *
     * @return $this
     */
    public function responseJson($bool)
    {
        $this->responseJson = !!$bool;

        return $this;
    }
}
