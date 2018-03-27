<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class GetTypeSms extends SupportAbstract
{

    /**
     * @var string
     */
    protected $urlSend = SoftsendConfigs::URL_TYPE_SMS;


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
        return $this->sendSupportGet();
    }

}

