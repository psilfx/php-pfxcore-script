<?php
	defined( "exec" ) or die();
	
	/**
	 ** @desc Абстрактный класс приложения
	 ** @author PsilFX
	 **/
	abstract class Application {
		//Объект исполняемого приложения
		protected object $_exec;
		//Переключатель, можно инициализировать только 1 раз
		private bool $_execsw = false;
		/**
		 ** @desc Задаёт исполняемый объект
		 **/
		public function SetExec( &$execObject ) {
			if( $this->_execsw ) return;
			$this->_exec   = $execObject;
			$this->_execsw = true;
		}
		/**
		 ** @desc Обязательный метод, исполняется 1 раз при загрузки приложения, точка входа по аналогии с языком C
		 **/
		abstract public function Main();
		
		abstract public function Controller();
		
		abstract public function Response(): string;
		
		public function GetLang( string $key ): string {
			return $this->_exec->Lang( $key );
		} 
	}
?>