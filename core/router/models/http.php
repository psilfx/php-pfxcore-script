<?php
	defined( "exec" ) or die();
	
	class AppCoreRouterModelsHttp extends Model {
		//Запрос к сайту
		private string $_request;
		//Запросы
		private array  $_array;
		//Запрашиваемая страница
		private string $_page;
		//Номер страницы
		private int    $_pagenum = 1;
		//Идёт ли запрос в админку
		private bool   $_admin = false;
		 
		public function __construct() {
			$this->_GetRequest();
			$this->_GetArray();
			$this->_GetPage();
			$this->_GetPageNum();
		}
		/**
		 ** @desc Запрос пользователя в строке, вырезаем get переменные метрик
		 **/
		private function _GetRequest(): void {
			$request        = explode( '?' , $_SERVER[ 'REQUEST_URI' ] );
			$this->_request = $request[ 0 ];
		}
		/**
		 ** @desc Массив запросов
		 **/
		private function _GetArray(): void {
			$this->_array = explode( '/' , $this->_request );
			$this->_array = array_values( array_filter( $this->_array ) );
			if( empty( $this->_array[ 0 ] ) ) $this->_array[ 0 ] = '';
		}
		/**
		 ** @desc Запрашиваемая страница
		 **/
		private function _GetPage(): void {
			$this->_page = $this->_array[ array_key_last( $this->_array ) ];
		}
		/**
		 ** @desc Номер страницы для постраничной навигации
		 **/
		private function _GetPageNum(): void {
			if( !str_contains( $this->_page , _page ) ) return;
			$this->_pagenum = max( (int)explode( '-' , $this->_page )[ 1 ] , 1 );
		}
		/**
		 ** @desc Методы возврата
		 **/
		public function String(): string {
			return $this->_request;
		}
		public function Array(): array {
			return $this->_array;
		}
		public function Page(): string {
			return $this->_page;
		}
		public function PageNum(): int {
			return $this->_pagenum;
		}
		public function IdNum(): int {
			if( !str_contains( $this->_page , _id ) ) return null;
			return (int)explode( '-' , $this->_page )[ 1 ];
		}
	}
?>