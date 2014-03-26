#PHP client library for iBL

Setup dependencies.

     composer install
     
    
Usage

    $params = array("api_key" => "", 
                    "availability" => "available",
                    "live" => "true"
    );
    if ($page === 'home') {
      $highlightsObject = new BBC_Tviplayer_Models_IblClient_Highlights_Home();
    } else {
      $highlightsObject = new BBC_Tviplayer_Models_IblClient_Highlights_Channel();
      $highlightsObject->setId($channelId);
    }
    try {
    	$highlights = $highlightsObject->fetch($params);
	} catch (IblClient_Exception $e) {

	}