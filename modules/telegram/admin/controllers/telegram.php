<?php
	defined( "exec" ) or die();

	class AppModulesTelegramAdminControllersTelegram extends Controller {
		
		private array  $_request;
		private string $_view; //Шаблон вывода
		private array  $_data; //Данные на вывод
		
		public function __construct( array $options = array() ) {
			$this->_request = $options[ 'request' ];
		}
		
		public function Main(): string {
			$this->_data = array();
			$this->_view = ( count( $this->_request ) < 3 ) ? 'dashboard' : 'category';
			return $this->_exec->GetView( $this->_view , $this->_data );
		}

		public function View() {
			return $this->_view;
		}
		public function Data() {
			return $this->_data;
		}
	}
?>