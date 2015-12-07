<?php

/*
	*
	*
	*
	*
	*
*/

function MySQL_select(){
	
	$params = func_get_args();
	
	$table = $params[0];
	$indecies = $params[1];
	$condition = isset($params[2]) ? $params[2] : NULL;
	
	$db_access = Client_MySQL::get_instance();
	
	$params = array(
		'table' => array($table),
		'index' => $indecies,
	);
	
	if( isset( $condition )){
		$params['condition'] = $condition;
	}
	else{
		$params['fetchAll'] = true;
	}
	
	$result = $db_access->db_fetch( $params );
	
	if( isset( $result->query ) ){
		foreach( $result->query as $index => $value ){
			$result->query[$index] = htmlspecialchars_decode( $value );
		}
	}
	
	return $result;
}

/*
	*
	*
	*
	*
	*
*/

function MySQL_fetch(){
	
	$params = func_get_args();
	
	$table = $params[0];
	$indecies = $params[1];
	$condition = isset($params[2]) ? $params[2] : NULL;
	
	$db_access = Client_MySQL::get_instance();
	
	$params = array(
		'table' => array($table),
		'index' => $indecies,
	);
	
	if( isset( $condition )){
		$params['condition'] = $condition;
	}
	else{
		$params['fetchAll'] = true;
	}
	
	$result = $db_access->db_fetch( $params )->query;
	
	if( isset( $result->query ) ){
		foreach( $result->query as $index => $value ){
			$result->query[$index] = htmlspecialchars_decode( $value );
		}
	}
	
	return $result;
}

/*
	*
	*
	*
	*
	*
*/

function MySQL_fetchAll(){
	
	$params = func_get_args();
	
	$table = $params[0];
	$indecies = $params[1];
	$condition = isset( $params[2] ) ? $params[2] : NULL;
	$limit = isset( $params[3] ) ? $params[3] : NULL;
	$offset = isset( $params[4] ) ? $params[4] : NULL;
	
	$db_access = Client_MySQL::get_instance();
	
	$params = array(
		'table' => array($table),
		'index' => $indecies,
	);
	
	if( $condition != NULL ){ 
		$params['condition'] = $condition;
	}
	if( $limit != NULL ){ 
		$params['limit'] = $limit;
	}
	if( $offset != NULL ){ 
		$params['offset'] = $offset;
	}
	
	$params['fetchAll'] = true;
	
	$result = $db_access->db_fetch( $params );
	
	if( isset( $result->query )){
		$i = 0;
		foreach( $result->query[$i] as $index => $value ){
			$result->query[$i][$index] = htmlspecialchars_decode( $value );
		}
	
		return $result->query;
	}
	else{
		return false;
	}
}

/*
	*
	*
	*
	*
	*
*/

function MySQL_update(){
	
	$params = func_get_args();
	
	$table = $params[0];
	$indecies = $params[1];
	$values = $params[2];
	$condition = $params[3];
	
	$db_access = Client_MySQL::get_instance();
	
	$params = array(
		'table' => array($table),
		'index' => $indecies,
		'value' => $values,
		'condition' => $condition,
	);
	
	$result = $db_access->db_update( $params );
	return $result;

}

/*
	*
	*
	*
	*
	*
*/

function MySQL_insert(){
	
	$params = func_get_args();
	
	$table = $params[0];
	$indecies = $params[1];
	$values = $params[2];
	
	$db_access = Client_MySQL::get_instance();
	
	$params = array(
		'table' => array($table),
		'index' => $indecies,
		'value' => $values,
	);
	
	$result = $db_access->db_insert( $params );
	return $result;

}