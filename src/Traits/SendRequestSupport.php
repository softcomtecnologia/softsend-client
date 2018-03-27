<?php

namespace Softcomtecnologia\SoftsendClient\Traits;

use Softcomtecnologia\Api\Exceptions\InvalidResponseException;
use Softcomtecnologia\SoftsendClient\Contracts\SupportAbstract;

trait SendRequestSupport
{

    /**
     * @return mixed
     */
    protected function sendSupportGet()
    {
        return $this->sendRequestBase('get');
    }


    /**
     * @return mixed
     */
    protected function sendSupportPost()
    {
        return $this->sendRequestBase('post');
    }


    /**
     * @param string $type
     *
     * @return mixed
     * @throws InvalidResponseException
     */
    protected function sendRequestBase($type)
    {
        if ($this->getDebugMode()) {
            return $this->responseToDebugMode();
        }

        try {
            $response = $this->provider->{$type}(
                $this->getToken(),
                $this->urlSend,
                $this->optionsProvider
            );
        } catch (InvalidResponseException $e) {

            $response = $e->getRequestParamsFromString();
        }

        return $this->prepareResponse($response);
    }
}

