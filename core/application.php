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
		//Основной контроллер приложения
		protected object $_controller;
		private bool $_controlsw = false;
		//Ответ приложения
		private string $_response;
		/**
		 ** @desc Задаёт исполняемый объект
		 **/
		public function SetExec( &$execObject ): void {
			if( $this->_execsw ) return;
			$this->_exec   = $execObject;
			$this->_execsw = true;
		}
		public function SetController( object &$controller ): void {
			if( $this->_controlsw ) return;
			$this->_controller = $controller;
			$this->_controlsw  = true;
		}
		/**
		 ** @desc Обязательный метод, исполняется 1 раз при загрузки приложения, точка входа по аналогии с языком C
		 **/
		abstract public function Main();
		
		public function Controller(): void {
			$this->_response = $this->_controller->Main();
		}

		public function GetLang( string $key ): string {
			return $this->_exec->Lang( $key );
		}
		/* Обработчик внутри шаблона */
		public function TemplateHandler( $handlerPath ): void {
			if( !is_file( $handlerPath ) ) return;
			$exec = $this->_exec;
			$app  = $exec->App();
			include $handlerPath;
		}
		public function Response(): string {
			return $this->_response;
		}
	}
?>