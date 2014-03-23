<?php

class IblClient_Models_Highlights_Channel extends IblClient_Models_Base implements IblClient_Models_Interface 
{
  public $elements = array();

  public $feed = "/channels/{id}/highlights";

  public $channel;

  /*
   * Hands std object to be built
   * Builds channel model as a property.
   */
  public function get($params) {
    $response = $this->_get($this->feed, $params);

    $channelModel = new BBC_Tviplayer_Models_IblClient_Channel();
    $channelModel->buildModel($response->channel_highlights->channel);
    $this->channel = $channelModel;

    $elements = $response->channel_highlights->elements;
    $this->buildModel($elements);
  }

  /*
   * Create IblClient model of each item, uses type
   */
  public function buildModel($objects) {
    foreach($objects as $object) {
        $className = $this->_className($object->type);
        $class = new $className();
        $class->buildModel($object);
        $this->elements[] = $class;
    }
  }

  public function setId($id) {
    $this->feed = str_replace("{id}", $id, $this->feed); 
  }

  public function getChannel() {
    return $this->channel;
  }

  private function _className($string) {
     $words = explode('_', strtolower($string));

      $return = $this->prefix;
      $count = 0;
      foreach ($words as $word) {
        if ($count > 0) {
          $return .=  "_" . ucfirst(trim($word));
        } else {
          $return .=  ucfirst(trim($word));
        }
        $count++;
      }
      return $return;
    }
}