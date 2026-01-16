<?php
	defined( "exec" ) or die();
	
	class AppCoreRouterControllersAccess extends Model {
		//Идёт ли запрос в админку
		private bool $_admin = false;
		private bool $_rest  = false;
		/**
		 ** @desc Проверяет, является ли запрос в админку
		 **/
		public function CheckAdmin( string $page ): void {
			if( $page == _administrator ) $this->_admin = true;
		}
		/**
		 ** @desc Проверяет, является ли запрос к апи
		 **/
		public function CheckRest( string $page ): void {
			if( $page == _restapi ) $this->_rest = true;
		}
		/**
		 ** @desc Методы возврата
		 **/
		public function Admin(): bool {
			return $this->_admin;
		}
		/**
		 ** 
		 **/
		public function RestApi(): bool {
			return $this->_rest;
		}
		
	}
?>