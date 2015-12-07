<?php
/*
	*	Forecast-FlyFishing.com
	*
	*	/applications/api/data_access/fetch.MySQL.php
	*
	*
	*
	*
	*
*/

class Fetch_MySQL extends MySQL_interface{
	
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
			if(isset($params->fetchAll) && $params->fetchAll == true){
				$row = $SQLpre->fetchAll(PDO::FETCH_ASSOC);
			}
			else{
				$row = $SQLpre->fetch(PDO::FETCH_ASSOC);
			}
			
			if(($row)){
				$this->query = $row;
				$this->rows = count($row);
				$this->error = "Success";
				return $this;
			}
			else{
				unset($this->query);
				$this->rows = 0;
				$this->error = "No results returned";
				return $this;
			}
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
	
	protected function build_MySQL_statement( $params ){
		
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
		
		if(isset($params->index)){
			if(gettype($params->index) == 'array'){
				$index = implode(", ", $params->index);
			}
			else{
				$index = $params->index;
			}
		}
		else{
			$index = "*";
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
		
		if(isset($params->order)){
			if(gettype($params->order == 'array')){
				$order = " order by ";
				$n = 0;
				foreach($params->order as $key => $val){
					$order.= $key." ".$val;
					if( (count($params->order) > 1) && ($n < count($params->order)-1) ){
						$order.= ", ";
					}
					$n++;
				}
			}
			else{
				$order = " ".$params->order;
			}
		}
		else{
			$order = "";
		}
		
		if(isset($params->limit)){
			if(gettype($params->limit) == 'integer'){
				$limit = " limit ".$params->limit;
			}
			elseif( gettype( $params->limit == 'array') ){
				$limit = " limit ".$params->limit['limit'];
			}
		}
		else{
			$limit = "";
		}
		
		if( isset($params->offset) && isset($params->limit) ){
			if(gettype($params->offset) == 'integer'){
				$offset = " offset ".$params->offset;
			}
			elseif( gettype( $params->offset == 'array' ) ){
				$offset = " offset ".$params->offset['offset'];
			}
		}
		else{
			$offset = "";
		}
		
		$SQL_statement = "select ".$index." from ".$table.$condition.$order.$limit.$offset;
		// echo $SQL_statement;
		return $SQL_statement;
	}
}