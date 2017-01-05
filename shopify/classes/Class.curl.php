<?php

class Curl
{
    private $curl = null;
    private $response = null;

    public function request($request, $fields = null, $json = true)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $request);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields) {
            curl_setopt($this->curl, CURLOPT_POST, 1);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, ($json ? json_encode($fields) : $fields));
            if ($json) {
                curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen(json_encode($fields)))                                                                       
                );                                                    
            }
        }
        
        return ($json ? $this->parseJson($this->execute()) : $this->execute());
    }

    public function parseJson($json)
    {
        $array = json_decode($json, true);
        return $array;
    }
    
    private function execute()
    {
        $response = curl_exec($this->curl);
        $error    = curl_error($this->curl);
        $errno    = curl_errno($this->curl);

        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
        }

        return $this->response = $response;
    }
}
