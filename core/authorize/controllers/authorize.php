<?php
	defined( "exec" ) or die();
	
	class AppCoreAuthorizeControllersAuthorize extends Controller {
		
		private array $_user;
		private bool  $_admin;
		private bool  $_active;
		
		public function __construct() {
			$this->_user = array();
		}
		
		public function Main() {
			$authModel     = $this->_exec->GetObjectByAlias( 'models_auth' );
			$this->_user   = $this->CheckUserByPassword( $authModel->GetUserFromDbByName( 'Losos' ) , 'pukito' );
			$this->_admin  = $this->CheckUserByAdmin( $this->_user );
			$this->_active = $this->CheckUserByActive( $this->_user );
			return ( $this->_admin ) ? $this->_exec->GetView( 'info' , $this->_user ) : $this->_exec->GetView( 'form' );
		}
		public function CheckUserByPassword( array $user , string $password  ): array {
			return ( password_verify( $password , Cli::ArraysLib()->Val( 'password' , $user ) ) ) ? $user : array();
		}
		public function CheckUserByAdmin( array $user ): bool {
			return Cli::ArraysLib()->CheckBool( 'admin' , $user );
		}
		public function CheckUserByActive( array $user ): bool {
			return Cli::ArraysLib()->CheckBool( 'active' , $user );
		}
		public function User(): array {
			return $this->_user;
		}
		public function Admin(): bool {
			return $this->_admin;
		}
		//Для REST запросов
		public function Rest(): bool {
			return ( $_SERVER[ 'HTTP_AUTHORIZATION' ] == _restapi_global_key );
		}
	}
?>