<?php
//ideally would have an autoload function but put here for this example
require_once('Class.curl.php');

Class Shopify {
    
    private $username = '891e445163f93310eb42f247cd52d12d';
    private $password = 'c985a33c72276f0b83e0eb113f48cf3e';
    private $apiUrl = ''; 
    private $Curl = null;
    
    function __construct()
    {
        $this->Curl = new Curl();
    }
    
    
    private function buildURL($dest = 'products.json')
    {
        return 'https://' . $this->username . ':' . $this->password . '@laits-runners.myshopify.com/admin/' . $dest;
    }
    
    public function get_products()
    {
        $url = $this->buildURL();
        
        return $this->Curl->request($url);
    }
    
    public function create_product($data) 
    {
        $url = $this->buildURL();
        
        return $this->Curl->request($url, $data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}





?>