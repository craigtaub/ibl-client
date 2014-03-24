<?php

class IblClient_Models_Category extends IblClient_Models_Elements implements IblClient_Models_Interface 
{
    public $feed = "/categories";

    public $kind = "";

    public $child_episode_count = 0;

    public function get($params) {
        $response = $this->_get($this->feed, $params);

        $elements = $response->categories;
        return $this->buildElements($elements);
    }

    public function buildModel($object) {
      foreach (get_object_vars($object) as $key => $value) {
          $this->$key = $value;
      }
    }

    public function getKind() {
        return $this->kind;
    }

    /**
     * Get the number of episodes for a category
     *
     * @return int
     */
    public function getChildEpisodeCount() {
        return $this->child_episode_count;
    }


    /**
     * Returns whether this category is a children's category
     * @return bool
     */
    public function isChildrens() {
        return $this->id == 'cbbc' || $this->id == 'cbeebies';
    }

}