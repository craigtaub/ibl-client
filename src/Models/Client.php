<?php

use Guzzle\Http\Client;

class IblClient_Models_Client
{

    public $prefix = "IblClient_Models_";

    public static $_baseUrl = "http://d.bbc.co.uk/";
    public static $_version = "ibl/v1/";
    public static $_client;

    public $defaultParams = array("api_key" => "",
                          "availability" => "all",
                          "lang" => "en",
                          "rights" => "web"
                      );

    protected function _get($feed, $params) {
        $params = array_merge($this->defaultParams, $params);
        $client = self::getClient();
        try {
          $request = $client->get(self::$_version . $feed . ".json", 
              array(), 
              array(
                'query' => $params,
               // 'proxy' =>  '',
              )
          );
        } catch (RequestException $e) {

        }
    //var_dump($request->getUrl());die;
        $response = $request->send();
        $response->getBody();
        $array = $response->json();

        $json = json_encode($array);
        $object = json_decode($json);
        return $object;
    }
    public static function getClient() {
      if (!self::$_client) {    
          $client = self::setClient();
          self::$_client = $client;
      }
      return self::$_client;
    }

    public static function setClient() {
      if (isset($_GET['_fake'])) {
        return new IblClient_Models_ClientFake();
      } 
      return new Client(self::$_baseUrl);
    }

}