<?php
	defined( "exec" ) or die();
	
	/**
	 ** @desc Абстрактный класс библиотеки
	 ** @author PsilFX
	 **/
	abstract class Library {
		
		private string $_name;
		private string $_dir; //Директория исполнения
		private string $_dir_view; //Директория выводов
		
		public function SetDir( string $dir ): bool {
			if( !empty( $this->_dir ) ) return false;
			$this->_dir = $dir;
			$this->_SetDirs();
			return true;
		}
		public function SetName( string $name ): bool {
			if( !empty( $this->_name ) ) return false;
			$this->_name = $name;
			return true;
		}
		private function _SetDirs(): void {
			$this->_dir_view = $this->_dir . 'view' . DS . $this->_name . DS;
		}
		protected function GetDir(): string {
			return $this->_dir;
		}
		protected function GetViewDir(): string {
			return $this->_dir_view;
		}
		protected function GetView( string $view , array $data = array() ) {
			ob_start();
				extract( $data , EXTR_PREFIX_ALL , 'field' );
				include $this->_dir_view . $view . '.php';
				$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}
	}
?>