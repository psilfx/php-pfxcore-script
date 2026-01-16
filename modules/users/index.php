<?php
	defined( "exec" ) or die();

	class AppModulesUsers extends Application {
		
		private string $_response;
		
		public function __construct( $options ) {
			$this->_options = $options;
		}
		public function Main() {
			$this->_controller = $this->_exec->Load( 'models' , 'user' );
		}
		
		public function Controller(): void {
			
		}
		
		public function Response(): string {
			return $this->_response;
		}
		
	}
?>