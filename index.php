<?php
		$params = array(
			//'SQL' => "SELECT * FROM sys_users",
			'table' => array('sys_users'),
			//'index' => array( '<>id', 'username', 'password', 'permission_id', 'user_role' ),
			//'condition' => array('id'=>1, 'username'=>"cmcantrell", 'permission'=>99),
			//'condition' => "where id=1 and username='cmcantrell'",
			//'order' => array('id'=>'DESC', 'username'=>'ASC'),
			//'order' => "order by id DESC",
			//'limit' => 5,
			//'offset' => 1,
			'fetchAll' => true,
		);
		
		$db_access = new Client_MySQL();
		
		//$db_access = Client_MySQL::get_instance();
		
		//$result = $db_access->db_fetch( $params );
		
		$result = MySQL_select('sys_users', array('username','password'));
		
		echo "<h2>Output</h2>";
		echo "<pre>";
		print_r($result);
		echo "</pre>";