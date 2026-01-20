<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersBot extends Controller {
		
		public function __construct() {
		}
		
		public function Main(): string {
			$model_bot = $this->_exec->GetObjectByAlias( 'models_bot' );
			$model_bot->InitFromData();
			return json_encode( $model_bot->CreateResponse() );
		}
	}
?>