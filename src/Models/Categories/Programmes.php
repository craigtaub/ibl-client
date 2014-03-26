<?php

class IblClient_Models_Categories_Programmes extends IblClient_Models_Elements implements IblClient_Models_Interface
{
    public $feed = "/categories/{categoryId}/programmes";

    public function get($params) {
        $response = $this->_get($this->feed, $params);

        $elements = $response->category_programmes;
        return $this->buildElements($elements);
    }

    public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
    }

    public function setId($id) {
        $this->feed = str_replace("{categoryId}", $id, $this->feed); 
    }
}