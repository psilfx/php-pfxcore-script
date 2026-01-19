<?php
	defined( "exec" ) or die();
	error_reporting( E_ALL );
	define( 'DS' , DIRECTORY_SEPARATOR );
	
	require _root_dir . DS . 'core' . DS . 'config.php';
	require _root_dir . DS . 'core' . DS . 'cli.php';
	require _root_dir . DS . 'core' . DS . 'exec.php';
	require _root_dir . DS . 'core' . DS . 'model.php';
	require _root_dir . DS . 'core' . DS . 'controller.php';
	require _root_dir . DS . 'core' . DS . 'application.php';
	
	$cli = Cli::GetInstance();
	
	define( '_cli_arrays_lib_key' , $cli->LoadLib( 'arrays' ) );
	define( '_cli_files_lib_key'  , $cli->LoadLib( 'files' ) );
	define( '_cli_data_lib_key'   , $cli->LoadLib( 'data' ) );
	
	define( '_cli_db_key'       , $cli->Load( 'core' , 'db'        , array() ) );
	define( '_cli_router_key'   , $cli->Load( 'core' , 'router'    , array() ) );
	define( '_cli_template_key' , $cli->Load( 'core' , 'template'  , array() ) );
	define( '_cli_users_key'    , $cli->Load( 'core' , 'users'     , array() ) );
	define( '_cli_auth_key'     , $cli->Load( 'core' , 'authorize' , array() ) );
	
	Cli::DB()->Controller();
	Cli::Router()->Controller();
	Cli::Auth()->Controller();
	
	function Lang( string $langKey ) {
		global $language;
		return $language[ $langKey ] ?? null;
	}
	
	$template = Cli::Template();
	$template->Controller();
	$template->Response();
	
?>