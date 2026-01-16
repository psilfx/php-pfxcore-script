<?php
	defined( "exec" ) or die();
	
	//База данных
	define( '_db_client'   , 'mysqlPdo' );
	define( '_db_server'   , '127.0.0.1' );
	define( '_db_user'     , 'root' );
	define( '_db_password' , '' );
	define( '_db_db'       , 'n8n' );
	define( '_db_prefix'   , '' );
	
	//Страницы
	define( '_page'          , 'page' );
	define( '_administrator' , 'zalupa' );
	//REST
	define( '_restapi'            , 'rest' );
	define( '_restapi_global_key' , 'token1234' );
?>