<?php
/*
	*	Forecast-FlyFishing.com
	*
	*	/applications/api/data_access/context.php
	*
	*
	*
	*
	*
*/

class Context_MySQL{
	
	private $handler;

/*
	*
	*
	*
	*
	*
*/

	public function __construct( $request ){
		
		$this->handler = $request;
	}

/*
	*
	*
	*
	*
	*
*/
	
	public function algorithm($params){
		
		$params = new collect_params($params);
		$result = $this->handler->init($params);
		
		//echo "<h2>Context</h2>";
		//echo "<pre>";
		//print_r($this);
		//echo "</pre>";
		
		return $result;	
	}
	
}
	
?>