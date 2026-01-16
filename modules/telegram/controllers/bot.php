<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersBot extends Controller {
		
		private array  $_options;
		
		public function __construct( array $options = array() ) {
			$this->_options = &$options;
		}
		
		public function Main(): string {
			$app = $this->_exec->App();
			$app->LoadBot();
			return "";
		}
		
	}
?>