<?php
	defined( "exec" ) or die();
	
	/**
	 ** @desc Абстрактный класс модели
	 ** @author PsilFX
	 **/
	abstract class Model {
		//Название исполняемой модели
		protected string $_modelExecName;
		//Объект исполняемого приложения
		protected object $_exec;
		//Ключ исполняемой модели
		protected int $_modelExecKey;
		//Переключатели
		private bool $_modelExecNamesw = false;
		private bool $_modelExecKeysw  = false;
		private bool $_execsw          = false;
		
		public function SetName( string $name ): void {
			$this->_SetVar( '_modelExecName' , $name );
		}
		public function SetKey( int $key ): void {
			$this->_SetVar( '_modelExecKey' , $key );
		}
		public function SetExec( &$execObject ) {
			$this->_SetVar( '_exec' , $execObject );
		}
		private function _SetVar( $name , $value ): void {
			$switch = $name . 'sw';
			//Если переменная уже задана, выходим
			if( $this->$switch ) return;
			$this->$name   = $value;
			$this->$switch = true;
		}
	}
?>