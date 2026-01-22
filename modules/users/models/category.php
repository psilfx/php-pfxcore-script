<?php
	defined( "exec" ) or die();
	
	class AppModulesUsersModelsCategory extends Model {
		
		private object $_db;
		
		public function __construct() {
			$this->_db     = Cli::DB();
			$this->_catSql = " SELECT * FROM `#__users_category` ";
		}
		public function GetAllCategories(): array {
			return $this->_DoRequest( $this->_catSql , array() );
		}
		private function _DoRequest( string $sql , array $values = array() ): array {
			$this->_db->Query( $sql , $values );
			return $this->_db->Array();
		}
	}
?>