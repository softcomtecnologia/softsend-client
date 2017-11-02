<?php

namespace Softcomtecnologia\SoftsendClient\Contracts;

use Softcomtecnologia\SoftsendClient\Configs\SoftsendConfigs;

abstract class SupportAbstract implements SupportInterface
{

    /**
     * @var string
     */
    protected $responseType = SoftsendConfigs::RESPONSE_TYPE_JSON;

    /**
     * @var array
     */
    protected $responsesAvailables = [
        SoftsendConfigs::RESPONSE_TYPE_JSON,
        SoftsendConfigs::RESPONSE_TYPE_OBJECT,
        SoftsendConfigs::RESPONSE_TYPE_STRING,
    ];


    /**
     * @param $response
     *
     * @return mixed
     */
    public function prepareResponse($response)
    {
        if ($this->responseType == SoftsendConfigs::RESPONSE_TYPE_STRING) {
            return $response;
        }

        return json_decode($response, $this->responseType == SoftsendConfigs::RESPONSE_TYPE_JSON);
    }


    /**
     * @param $type
     *
     * @return $this
     * @throws \Exception
     */
    public function responseType($type)
    {
        if (in_array($type, $this->responsesAvailables)) {
            $this->responseType = $type;

            return $this;
        }

        throw new \Exception("The type `$type` is not valid");
    }

}