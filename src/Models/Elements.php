<?php

class IblClient_Models_Elements extends IblClient_Models_Base
{

    public $type;
    public $synopses;
    public $master_brand;
    public $images;

    /**
     * Get the short synopsis (if available)
     *
     * @return string
     */
    public function getShortSynopsis() {
        if (isset($this->synopses->small)) {
            return $this->synopses->small;
        }
        return "";
    }

    /**
     * Get the standard image url for an element
     *
     * @param string|int $width  Desired width of image (default 336).
     *                           if not an integer indictes a recipe name
     * @param int $height Desired height of image (default 189)
     *
     * @return string
     */
    public function getStandardImage($width = 336, $height = 189) {
        if (isset($this->images->standard)) {
            return str_replace('{recipe}', $this->_getRecipe($width, $height), $this->images->standard);
        }
        return "";
    }

    /**
     * Get the master brand name
     *
     * @return string
     */
    public function getMasterBrand() {
        // @codingStandardsIgnoreStart
        if (isset($this->master_brand->titles)) {
            $titles = $this->master_brand->titles;
            if (isset($titles->small)) {
                return $titles->small;
            }
        }
        // @codingStandardsIgnoreEnd
        return "";
    }

    /**
     * Returns the recipe for a specific width x height or a recipe name
     *
     * @param string|int $width  Desired width of image
     *                           if not an integer it's a recipe name
     * @param int $height Desired height of image
     * @access private
     * @return void
     */
    private function _getRecipe($width, $height) {
        return is_numeric($width) ? "{$width}x{$height}":$width;
    }
}