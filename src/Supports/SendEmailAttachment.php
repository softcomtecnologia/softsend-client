<?php

namespace Softcomtecnologia\SoftsendClient\Supports;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;

class SendEmailAttachment extends SendEmail
{

    /**
     * @var string
     */
    protected $urlSend = SoftsendConfigs::URL_SEND_EMAIL_ATTACHMENT;
    
    
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
        parent::__construct($data, $clientId, $clientSecret, $domain);
        $this->prepareAttachment();
    }
    
    
    /**
     * @return void
     */
    protected function prepareAttachment()
    {
        if (!isset($this->optionsProvider['data']['attachment']) ||
            !is_array($attachments = $this->optionsProvider['data']['attachment'])
        ) {
            return;
        }
        
        $this->optionsProvider['data']['attachment'] = array_map([PathInfoSupport::class, 'create'], $attachments);
    }
}

