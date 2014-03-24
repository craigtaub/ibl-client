<?php

class IblClient_Models_Group_Large extends IblClient_Models_Elements implements IblClient_Models_Interface
{
    public $initial_children;
    public $pisodes;
    public $stacked;
    public $count = 0;

    public function get($params) {
    }

    public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
    }

    /**
     * @todo Not sure this is relevant any longer
     */
    public function getEpisodes() {
        // @codingStandardsIgnoreStart
        $episodes = array();
        foreach ($this->initial_children as $episode) {
            if ($episode->type === 'broadcast') {
                $episodeModel = new IblClient_Models_Broadcast();
            } else {
                $episodeModel = new IblClient_Models_Episode();
            }
            $episodeModel->buildModel($episode);
            $episodes[] = $episodeModel;
        }
        return $episodes;
        // @codingStandardsIgnoreEnd
    }

    /**
     * Get the number of episodes within this group object
     */
    public function getEpisodeCount() {
        return count($this->getEpisodes());
    }

    /**
     * Get the total number of episodes in this group
     */
    public function getTotalEpisodeCount() {
        // @codingStandardsIgnoreStart
        return $this->count;
        // @codingStandardsIgnoreEnd
    }

    /**
     * Is the group stacked? (All episodes share programme)
     *
     * @return boolean
     */
    public function isStacked() {
        return !!$this->stacked;
    }
}