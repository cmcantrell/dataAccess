<?php

class collect_params{

/*
	*
	*
	*
	*
	*
*/

	public function __construct( $params ){
		
		$db_strip_tags = isset( $params['strip_tags'] ) ? $params['strip_tags'] : false;
		
		foreach( $params[0] as $key => $value ){
			if($key != 'SQL'){
				if( gettype( $value ) == 'array' ){
					foreach( $value as $index => $val ){
						$index = $this->db_purge($index);
						$value[$index] = $this->db_purge($val);
						$this->$key = $value;
					} 
				}
				else{
					$this->$key = $this->db_purge( $value );
				}
			}
			else{
				$this->$key = $value;
			}
		}
		
		//echo "<h2>Collect Params</h2>";
		//echo "<pre>";
		//print_r($this);
		//echo "</pre>";
	}
	
	public static function db_purge($input){
		
		$output = htmlentities( $input, ENT_QUOTES );
		
		return $output;
		
	}
	
}


?>