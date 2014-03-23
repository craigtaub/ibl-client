<?php

class IblClient_Models_Base extends IblClient_Models_Client
{

    public $id;
    public $title;
    
    public function getId() {
      return $this->id;
    }

    public function getType() {
      return $this->type;
    }

}