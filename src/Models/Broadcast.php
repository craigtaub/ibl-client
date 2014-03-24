<?php

class IblClient_Models_Broadcast extends IblClient_Models_Elements
{
    public $type = "";
    public $start_time = "";
    public $end_time = "";
    public $duration = array();
    public $episode = "";

    public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
    }

    /**
     * Get type 
     * 
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Get start time from episode
     * 
     * @return string
     */
    public function getStartTime() {
        return $this->start_time;
    }

    /**
     * Get end time from episode
     * 
     * @return string
     */
    public function getEndTime() {
        return $this->end_time;
    }

    /**
     * Get episode inside Broadcast
     * 
     * @return BBC_Service_Bamboo_Models_Episode
     */
    public function getEpisode() {
        $episodeModel = new IblClient_Models_Episode();
        $episodeModel->buildModel($this->episode);
        return $episodeModel;
    }

}