<?php

use Guzzle\Http\Client;

class IblClient_Models_Client
{

    public $prefix = "IblClient_Models_";

    public static $_baseUrl = "http://open.live.bbc.co.uk/";
    public static $_version = "ibl/v1/";
    public static $_client;

    public $defaultParams = array("api_key" => "",
                          "availability" => "all",
                          "lang" => "en",
                          "rights" => "web"
                      );

    public function buildMeta($object) {
        $this->version = $object->version;
        $this->schema = $object->schema;
        $this->timestamp = $object->timestamp;
    }

    public function buildElements($elements) {
      $array = array();
      foreach ($elements as $element) {
        $className = get_class($this);
        $object = new $className;
        $object->buildModel($element);
        $array[] = $object;
      }
      return $array;
    }

    protected function _get($feed, $params) {
        $params = array_merge($this->defaultParams, $params);
        $client = self::getClient();
        $request = $client->get(self::$_version . $feed, array(), array('query' => $params));
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