<?php
	defined( "exec" ) or die();
	/**
	 ** @desc Класс адаптер для работы с БД
	 ** @author PsilFX
	 **/
	class AppCoreDb extends Application {
		private object $_db;
		
		public function __construct() {
			
		}
		public function Main() {
			$this->_db = $this->_exec->Load( 'models' , _db_client );
		}
		
		public function Controller() {
			
		}
		
		public function Query( string $sql , array $values = array() ): void {
			$this->_db->Query( $sql , $values );
		}
		public function Row() {
			return $this->_db->FetchRow();
		}
		public function Array() {
			return $this->_db->FetchArray();
		}
		public function CreateSql( array $array , string $table ): string {
			return $this->_db->CreateSqlFromArr( $array , $table );
		}
		public function Response(): string {
			
		}
	}
?>