<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;
use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

class SendEmail extends SupportAbstract
{

    /**
     * @var string
     */
    protected $urlSend = SoftsendConfigs::URL_SEND_EMAIL;


    /**
     * @param array  $data
     * @param string $clientId
     * @param string $clientSecret
     * @param string $domain
     */
    public function __construct(
        array $data = [],
        $clientId = '',
        $clientSecret = '',
        $domain = SoftsendConfigs::URL_DOMAIN
    ) {
        parent::__construct(get_defined_vars());
    }


    /**
     * @var mixed
     */
    public function support()
    {
        return $this->sendSupportPost();
    }
}
