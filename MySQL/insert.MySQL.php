<?php
/*
	*	Forecast-FlyFishing.com
	*
	*	/applications/api/data_access/update.MySQL.php
	*
	*
	*
	*
	*
*/

class Insert_MySQL extends MySQL_interface{
	
/*
	*
	*
	*
	*
	*
*/
	
	public function init($params){
		
		$connection = $this->MySQL_connect();
		
		if(isset($params->SQL)){
			$SQL_statement = $params->SQL;
		}
		else{
			$SQL_statement = $this->build_MySQL_statement($params);
		}
		$this->SQL = $SQL_statement;
		
		try{
			$SQLpre=$connection->prepare($SQL_statement);
			$SQLpre->execute();
			$this->error = "Success";
			return $this;
			
		}
		catch (PDOException $e){
			
			$this->SQL = $SQL_statement;
			$this->error = "Query failed: ".$e->getMessage();
			
			return $this;
		}
	}
	
/*
	*
	*
	*
	*
	*
*/
	
	protected function build_MySQL_statement($params){
		
		if( isset( $params->table )){
			if( gettype( $params->table ) == 'array' ){
				$table = implode( ", ", $params->table );
			}
			elseif( gettype( $params->table ) == 'string' ){
				$table = $params->table;
			}
			else{
				$table = NULL;
			}
		}else{
			$table = NULL;
		}
		if( isset( $params->index )){
			if( gettype( $params->index ) == 'array' ){
				$index = "";
				$i = 0;
				foreach( $params->index as $value ){
					$index.= $value;
					if( $i < count( $params->index ) - 1 ){
						$index.= ",";
					}
					$i++;
				}
			}
			elseif( gettype( $params->index ) == 'string' ){
				$index = $index;
			}
			else{
				$index = NULL;
			}
		}else{
			$index = NULL;
		}
		if( isset( $params->value )){
			if( gettype( $params->value ) == 'array' ){
				$values = "";
				$i = 0;
				foreach( $params->value as $value ){
					$values.= "'".$value."'";
					if( $i < count( $params->value ) - 1 ){
						$values.= ",";
					}
					$i++;
				}
			}
			elseif( gettype( $params->value ) == 'string' ){
				$values = $params->value;
			}
			else{
				$values = NULL;
			}
		}else{
			$values = NULL;
		}
	
		$SQL_statement="insert into $table ($index) values($values);";
		//echo $SQL_statement;
		return $SQL_statement;
	}
}