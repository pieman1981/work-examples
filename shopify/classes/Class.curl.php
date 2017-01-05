<?php
/**
* Contains the CurlModel class which facilitates the use of Curl requests
*
* @package ControlPanel
* @subpackage Models
* @author Simon Lait <simon.lait@s2partnership.co.uk>
* @version 1.0
* @copyright Copyright (c) 2015, S2 Partnership Ltd.
* @filesource
*/

    /**
    * CurlModel Class - facilitates the use of CURL
    *
    * @package ControlPanel
    * @subpackage Models
    */
    class Curl
    {
        private $curl = null;
        private $response = null;
        
        /**
        * CURL one off
        */
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

        /**
        * Parses a Codebase CURL result into a PHP array from JSON
        *
        * @param string $json The Json string generated from CURL
        */
        public function parseJson($json)
        {
            $array = json_decode($json, true);
            return $array;
        }
    }
