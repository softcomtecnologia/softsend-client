<?php

namespace Softcomtecnologia\SoftsendClient\Supports;


class PathInfoSupport
{
    /**
     * @var array
     */
    private $data = [];
    
    
    /**
     * PathInfoSupport constructor.
     *
     * @param $data
     */
    protected function __construct($data)
    {
        $this->setData($data);
    }
    
    
    /**
     * @param $data
     *
     * @return array
     */
    public static function create($data)
    {
        $static = new static($data);
        
        if (!$static->isValid()) {
            return [];
        }
        
        return $static->getData();
    }
    
    
    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    
    /**
     * @return bool
     */
    public function isValid()
    {
        $expected = array_fill_keys(['dirname', 'basename', 'extension', 'filename'], 'fill');
        
        if (($isValid = !array_diff_key($expected, $this->getData()))) {
            $this->data['filename'] = "{$this->data['filename']}.{$this->data['extension']}";
            $fileName = "{$this->data['dirname']}/{$this->data['filename']}";
            $this->data['fileContent'] = file_exists($fileName) ? file_get_contents($fileName) : null;
        }
        
        return $isValid;
    }
    
    
    /**
     * @param string|array $data
     *
     * @return $this
     */
    protected function setData($data)
    {
        if (is_string($data) && file_exists($data)) {
            $data = pathinfo($data);
        }
        
        $this->data = (array) $data;
        
        return $this;
    }
}

