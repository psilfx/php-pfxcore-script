<?php
	defined( "exec" ) or die();
	
	class AppModulesUsersModelsCategory extends Model {
		
		private object $_db;
		
		public function __construct() {
			$this->_db     = Cli::DB();
			$this->_catSql = " SELECT * FROM `#__users_category` ";
		}
		public function GetAllCategories(): array {
			$this->_db->Query( $this->_catSql , array() );
			return $this->_db->Array();
		}
		public function GetCategoryById( int $id ): array {
			return $this->_DoRequest( $this->_catSql . "WHERE `id` = :id " , array( ':id' => $id ) );
		}
		private function _DoRequest( string $sql , array $values = array() ): array {
			$this->_db->Query( $sql , $values );
			return $this->_db->Row();
		}
	}
?>