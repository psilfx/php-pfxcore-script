<?php
	defined( "exec" ) or die();

	class AppCoreAuthorize extends Application {
		
		private object $_auth;
		
		public function __construct() {
			
		}
		public function Main() {
			$this->_auth = $this->_exec->Load( 'models' , 'auth' );
		}

		public function Auth(): object {
			return $this->_auth;
		}
		
		public function User(): array {
			return $this->_controller->User();
		}
		
		public function Admin(): bool {
			return $this->_controller->Admin();
		}
		
		public function Rest(): bool {
			return $this->_controller->Rest();
		}
	}
?>