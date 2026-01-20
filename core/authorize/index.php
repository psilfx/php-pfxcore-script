<?php
	defined( "exec" ) or die();

	class AppCoreAuthorize extends Application {
		
		private object $_icontroller;
		
		public function __construct() {
			
		}
		public function Main() {
			$this->_auth        = $this->_exec->Load( 'models' , 'auth' );
			$this->_icontroller = $this->_exec->GetObjectByAlias( 'controllers_authorize' );
		}

		public function User(): array {
			return $this->_icontroller->User();
		}
		
		public function Admin(): bool {
			return $this->_icontroller->Admin();
		}
		
		public function Rest(): bool {
			return $this->_icontroller->Rest();
		}
	}
?>