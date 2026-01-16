<?php
	defined( "exec" ) or die();

	class AppModulesTelegramAdmin extends Application {
		
		private array  $_options;
		private object $_loader;
		
		public function __construct( $options ) {
			$this->_options = $options;
		}
		public function Main() {
			$this->_loader = $this->_exec->Load( 'controllers' , 'loader' , $this->_options );
		}
		
		public function Controller(): void {
			$this->_loader->Main();
			$this->_response = $this->_exec->GetView( $this->_loader->View() , $this->_loader->Data() );
		}
		
		public function Response(): string {
			return $this->_response;
		}
	}
?>