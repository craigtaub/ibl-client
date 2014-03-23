<?php

class IblClient_Models_Channel extends IblClient_Models_Base implements IblClient_Models_Interface 
{
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

  public function getUnregionalisedID() {
      if (preg_match('/(bbc_[a-z]+)(_.+)/i', $this->id, $matches)) {
          return $matches[1];
      }
      return $this->id;
  }

  public function getSlug() {
      return preg_replace('/[0-9_]/', '', $this->getUnregionalisedID());
  }

  /**
   * Returns whether this channel is a children's channel
   * @return bool
   */
  public function isChildrens() {
      return $this->id == 'cbbc' || $this->id == 'cbeebies';
  }
}