<?php
	defined( "exec" ) or die();

	class AppModulesContent extends Application {
		
		private object $_article;
		private object $_category;
		private object $_controller;
		private array  $_options;
		private string $_response;
		
		public function __construct( $options ) {
			$this->_options = $options;
		}
		private function _LoadModels(): void {
			$this->_article  = $this->_exec->Load( 'models' , 'article' );
			$this->_category = $this->_exec->Load( 'models' , 'category' );
		}
		public function Main() {
			$this->_LoadModels();
			$this->_controller = $this->_exec->Load( 'controllers' , 'content' , $this->_options );
		}
		
		public function Controller(): void {
			$this->_response = $this->_controller->Main();
		}
		public function Article(): object {
			return $this->_article;
		}
		public function Category(): object {
			return $this->_category;
		}

		public function Response(): string {
			return $this->_response;
		}
	}
?>