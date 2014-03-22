<?php

interface IblClient_Models_Interface 
{
  /*
   * grabs feed run 
   */
  public function get($params);

  /*
   * builds model based on feed
   */
  public function buildModel($object);
}