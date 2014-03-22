<?php

class IblClient_Models_Highlights_Home extends IblClient_Models_Base implements IblClient_Models_Interface 
{
  public $elements = array();

  public $feed = "/home/highlights";
  /*
   * Hands std object to be built
   */
  public function get($params) {
    $response = $this->_get($this->feed, $params);
    $elements = $response->home_highlights->elements;

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