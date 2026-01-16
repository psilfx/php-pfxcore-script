<?php
	defined( "exec" ) or die();
	
	class AppCoreUsersControllersUser extends Controller {
		
		public function __construct() {

		}
		
		public function Main() {

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