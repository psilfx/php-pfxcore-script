<?php
	defined( "exec" ) or die();

	class AppCoreAuthorize extends Application {
		
		private object $_auth;
		private object $_controller;
		
		public function __construct() {
			
		}
		public function Main() {
			$this->_auth       = $this->_exec->Load( 'models'      , 'auth' );
			$this->_controller = $this->_exec->Load( 'controllers' , 'auth' );
		}
		
		public function Controller() {
			$this->_controller->Main();
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
		
		public function Response(): string {
			return ( $this->Admin() ) ? $this->_exec->GetView( 'info' , $this->User() ) : $this->_exec->GetView( 'form' );
		}
	}
?>