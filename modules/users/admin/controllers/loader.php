<?php
	defined( "exec" ) or die();

	class AppModulesUsersAdminControllersLoader extends Controller {
		
		private array  $_request;
		private string $_view; //Шаблон вывода
		private array  $_data; //Данные на вывод
		
		public function __construct( array $options = array() ) {
			$this->_request = $options[ 'request' ];
		}
		
		public function Main(): void {
			$this->_data = array();
			$this->_view = ( count( $this->_request ) < 3 ) ? $this->_Dashboard() :  $this->_Category();
		}
		
		private function _Dashboard(): string {
			return 'dashboard';
		}
		
		private function _Category(): string {
			return 'category';
		}
		
		public function View() {
			return $this->_view;
		}
		public function Data() {
			return $this->_data;
		}
	}
?>