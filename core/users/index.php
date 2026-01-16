<?php
	defined( "exec" ) or die();

	define( '_core_users_view_user'     , 'user' );
	define( '_core_users_view_category' , 'category' );

	class AppCoreUsers extends Application {
		
		private object $_user;
		private object $_category;
		private array  $_data;
		private object $_controller;
		
		public function __construct() {
			$this->_data = array();
		}
		public function Main() {
			$this->_user       = $this->_exec->Load( 'models' , 'user' );
			$this->_category   = $this->_exec->Load( 'models' , 'category' );
			$this->_controller = $this->_exec->Load( 'controllers' , 'user' );
		}
		
		public function Controller() {

		}
		
		public function GetUserById( int $id ): array {
			return $this->_data = $this->_controller->CheckFields( $this->_user->GetUserFromDbById( $id ) );
		}
		
		public function GetUserByName( string $name ): array {
			return $this->_data = $this->_controller->CheckFields( $this->_user->GetUserFromDbByName( $name ) );
		}
		
		public function GetCategoryById( int $id ): array {
			return $this->_data = $this->_category->GetCategoryFromDbById( $id );
		}
		
		public function GetCategoryByName( string $name ): array {
			return $this->_data = $this->_category->GetCategoryFromDbByName( $name );
		}
		
		public function Response(): string {
			$this->_exec->GetView( $this->_controller->View( $this->_data ) , $this->_data );
		}
	}
?>