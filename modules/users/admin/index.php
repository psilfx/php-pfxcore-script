<?php
	defined( "exec" ) or die();

	class AppModulesUsersAdmin extends Application {
		
		private array  $_options;
		
		public function __construct( $options ) {
			$this->_options = $options;
		}
		public function Main() {
			$this->_exec->Load( 'models' , 'category' , array() , false );
		}
	}
?>