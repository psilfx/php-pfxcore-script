<?php
	defined( "exec" ) or die();
	
	class AppCoreUsersModelsCategory extends Model {
		
		private object $_db;
		private string $_sql;
		
		public function __construct() {
			$this->_db      = Cli::DB();
			$this->_sql = " SELECT * FROM `#__users_category` ";
		}
		
		public function GetCategoryFromDbByName( string $name ): array {
			return $this->_DoRequest( $this->_sql . "WHERE `name` = :name " , array( ':name' => $name ) );
		}
		public function GetCategoryFromDbById( int $id ): array {
			return $this->_DoRequest( $this->_sql . "WHERE `id` = :id " , array( ':id' => $id ) );
		}
		private function _DoRequest( string $sql , array $values = array() ): array {
			$this->_db->Query( $sql , $values );
			return $this->_db->Row();
		}
	}
?>