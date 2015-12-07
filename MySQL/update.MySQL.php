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

class Update_MySQL extends MySQL_interface{
	
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
		
		if(isset($params->table)){
			if(gettype($params->table) == 'array'){
				$table=implode(", ", $params->table);
			}
			else{
				$table = $params->table;
			}
		}
		else{
			$table = "";
		}
		
		if(gettype(($params->index)=='array')&&(gettype($params->value)=='array')){
			if(count($params->index)==(count($params->value))){
				$i=0;
				$index="";
				foreach($params->index as $key){
					if( gettype($params->value[$i]) == 'integer' ){
						$index.=$params->index[$i]."=".$params->value[$i];
					}
					else{
						$index.=$params->index[$i]."='".$params->value[$i]."'";
					}
					if($i<count($params->index)-1){
						$index.=", ";
					}
					$i++;
				}
			}
		}
		elseif((gettype($params->index)=="string")&&(gettype($params->value)=="string")){
			$index=$params->index."='".$params->value."'";
		}
		else{
			$index=NULL;
		}
		
		if(isset($params->condition)){
			if(gettype($params->condition) == 'array'){
				$condition = " where ";
				$n = 0;
				foreach($params->condition as $key => $val){
					if(gettype($val) == 'integer'){
						$condition.= $key."=".$val;
					}
					else{
						$condition.= $key."='".$val."'";
					}
					if( (count($params->condition) > 1) && ($n < count($params->condition)-1) ){
						$condition.= " and ";
					}
					$n++;
				}
			}
			else{
				$condition = " ".$params->condition;
			}
		}
		else{
			$condition = "";
		}

		$SQL_statement = "update ".$table." set ".$index.$condition;
		return $SQL_statement;
	}
}