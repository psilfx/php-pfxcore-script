<?php
	defined( "exec" ) or die();
	
	class AppCoreRouterControllersAccess extends Model {
		//Идёт ли запрос в админку
		private bool $_admin = false;
		/**
		 ** @desc Проверяет, является ли запрос в админку
		 **/
		public function CheckAdmin( string $page ): void {
			if( $page == _administrator ) $this->_admin = true;
		}
		/**
		 ** @desc Методы возврата
		 **/
		public function Admin(): bool {
			return $this->_admin;
		}
	}
?>