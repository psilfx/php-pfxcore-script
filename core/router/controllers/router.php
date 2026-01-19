<?php
	defined( "exec" ) or die();
	
	class AppCoreRouterControllersRouter extends Controller {

		public function __construct( array $options = array() ) {
			
		}
		
		public function Main(): string {
			$http     = $this->_exec->GetObjectByAlias( 'models_http' );
			$access   = $this->_exec->GetObjectByAlias( 'controllers_access' );
			$rootPage = $http->Array()[ 0 ];
			$access->CheckAdmin( $rootPage );
			$access->CheckRest( $rootPage );
			return "";
		}
		
	}
?>