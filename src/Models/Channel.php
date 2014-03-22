<?php

class IblClient_Models_Channel extends IblClient_Models_Base implements IblClient_Models_Interface 
{
  public $id;
  public $title;

  public $feed = "/channels";

  public function get($params) {
    $response = $this->_get($this->feed, $params);

    $elements = $response->channels;
    return $this->buildElements($elements);
  }

  public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
  }

}