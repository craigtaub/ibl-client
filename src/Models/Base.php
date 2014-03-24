<?php

class IblClient_Models_Base extends IblClient_Models_Client
{

    public $id;
    public $title;
    
    public function getId() {
      return $this->id;
    }

    public function getTitle() {
      return $this->title;
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

}