<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersTelegram extends Controller {
		
		public function __construct() {

		}
		
		public function Main(): string {
			$controller_webhook = $this->_exec->GetObjectByAlias( 'controllers_webhook' );
			$controller_bot     = $this->_exec->GetObjectByAlias( 'controllers_bot' );
			$this->_exec->WriteTempDataValue( 'data_webhook' , 'bot_message' , $controller_bot->Main() );
			return $controller_webhook->Main();
		}
	}
?>