<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersAccess extends Model {
		
		private bool $_rest;
		private bool $_webhook;
		
		public function __construct( array $options = array() ) {
			
			$router = Cli::Router();
			$page   = $router->Page();
			
			$this->_rest    = ( $options[ 'rest' ]    == $page );
			$this->_webhook = ( $options[ 'webhook' ] == $page );
		}
		/**
		 ** @desc Проверяет, является ли запрос в админку
		 **/
		public function Rest(): bool {
			return $this->_rest;
		}
		/**
		 ** @desc Методы возврата
		 **/
		public function Webhook(): bool {
			return $this->_webhook;
		}
	}
?>