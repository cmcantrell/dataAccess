<?php

define( 'DA_API_PATH', $_SERVER['DOCUMENT_ROOT'].'/applications/api/data_access/' );
require( DA_API_PATH.'MySQL/client.php' );
require( DA_API_PATH.'context.php');
require( DA_API_PATH.'MySQL/interface.MySQL.php');
require( DA_API_PATH.'collect_params.php');
include( DA_API_PATH.'functions.MySQL.php');
include( DA_API_PATH.'MySQL/fetch.MySQL.php');
include( DA_API_PATH.'MySQL/insert.MySQL.php');
include( DA_API_PATH.'MySQL/update.MySQL.php');
include( DA_API_PATH.'MySQL/delete.MySQL.php');

define( 'DB_HOST', '' );
define( 'DB_NAME','' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_USER','' );
define( 'DB_PASS','' );