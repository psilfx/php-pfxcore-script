<?php
	defined( "exec" ) or die();
	
	class AppModulesContentControllersContent extends Controller {
		
		private array  $_options;
		
		public function __construct( array $options = array() ) {
			$this->_options = &$options;
		}
		
		public function Main(): string {
			$app = $this->_exec->App();
			return $this->_exec->GetView( 'article' );
		}
	}
?>