<?php

class IblClient_Models_Episode extends IblClient_Models_Base implements IblClient_Models_Interface 
{
  public $synopses = array();
  public $master_brand = array();

  private $_feed = "/episodes/";
  private $_episodes = array();

  public function get($params) {
    $feed = $this->_feed . join(",", $this->_episodes);
    $response = $this->_get($feed, $params);

    $elements = $response->episodes;
    return $this->buildElements($elements);
  }

  public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
  }

  public function setEpisodes($episodes = array()) {
    $this->_episodes = $episodes;
  }

}