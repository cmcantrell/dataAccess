<?php
/*
	*	Forecast-FlyFishing.com
	*
	*	/applications/api/data_access/interface.MySQL.php
	*
	*
	*
	*
	*
*/

abstract class MySQL_interface{
	
	private $connection = NULL;
	public $SQL;
	public $error;
	public $rows;
	public $query;

/*
	*
	*
	*
	*
	*
*/

	protected function MySQL_connect(){
		
		if($this->connection instanceof self){
			return $this->connection;
		}
		
		try{
			$connection = new PDO( "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,DB_USER, DB_PASS );
			$connection->setAttribute( PDO::ATTR_PERSISTENT,true );
			$connection->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
			$this->connection = $connection;
			return $connection;
		}
		catch( PDOException $e ){
			die( "connection failed: ".$e->getMessage() );
		}
		
	}
	
	abstract protected function build_MySQL_statement($params);
	
}