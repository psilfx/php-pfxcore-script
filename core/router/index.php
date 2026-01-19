<?php
	defined( "exec" ) or die();

	class AppCoreRouter extends Application {
		
		private object $_http;
		private object $_access;
		
		public function __construct() {
			
		}
		public function Main() {
			$this->_http   = $this->_exec->Load( 'models'      , 'http' );
			$this->_access = $this->_exec->Load( 'controllers' , 'access' );
		}
		
		public function String(): string {
			return $this->_http->String();
		}
		public function Array(): array {
			return $this->_http->Array();
		}
		public function Page(): string {
			return $this->_http->Page();
		}
		public function PageNum(): int {
			return $this->_http->PageNum();
		}
		public function Admin(): bool {
			return $this->_access->Admin();
		}
		public function RestApi(): bool {
			return $this->_access->RestApi();
		}
	}
?>