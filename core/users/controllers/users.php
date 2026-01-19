<?php
	defined( "exec" ) or die();
	
	class AppCoreUsersControllersUsers extends Controller {
		
		public function __construct() {

		}
		
		public function Main(): string {
			return $this->_exec->GetView( $this->View( $this->_data ) , $this->_data );;
		}
		public function CheckFields( array $user ): array {
			if( empty( $user[ 'image' ] ) ) $user[ 'image' ] = DS . 'core' . DS . 'assets' . DS . 'images' . DS . 'no-image.jpg';
			return $user;
		}
		
		public function View( array $data ): string {
			return ( isset( $data[ 'password' ] ) ) ? 'user' : 'category';
		}
	}
?>