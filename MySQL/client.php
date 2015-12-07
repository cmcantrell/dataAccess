<?php
/*
	*	Forecast-FlyFishing.com
	*
	*	/applications/api/data_access/client.php
	*
	*
	*
	*
	*
*/

class Client_MySQL{
	
	private static $instance;
	
	public static function get_instance(){
		if( !self::$instance instanceof self ){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
/*
	*
	*
	*
	*
	*
*/
	
	public function db_fetch(){
		
		$params = func_get_args();
		$context = new Context_MySQL( new Fetch_MySQL() );
		$result = $context->algorithm( $params );
		return $result;
	}
	
	public function db_insert(){
		
		$params = func_get_args();
		$context = new Context_MySQL( new Insert_MySQL() );
		$result = $context->algorithm( $params );
		return $result;
	}
	
	public function db_update(){
		
		$params = func_get_args();
		$context = new Context_MySQL( new Update_MySQL() );
		$result = $context->algorithm( $params );
		return $result;
	}
	
	public function db_delete(){
		
		$params = func_get_args();
		$context = new Context_MySQL( new Delete_MySQL() );
		$result = $context->algorithm( $params );
		return $result;
	}
}