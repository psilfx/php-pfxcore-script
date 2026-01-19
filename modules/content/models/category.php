<?php
	defined( "exec" ) or die();
	
	class AppModulesContentModelsCategory extends Model {
		
		private bool $_filter_public = true;
		
		public function __construct() {

		}
		public function GetCategoryById( int $id ): array {
			$db  = Cli::DB();
			$sql = "SELECT * FROM #__content_category WHERE `id` = :id AND ( " . $this->_GetFilterSql() . ")";
			$db->Query( $sql , array( ':id' => $id ) );
			return $db->Row();
		}
		public function GetCategoriesByIds( array $ids ): array {
			$db  = Cli::DB();
			$pp  = $db->CreatePlaceholdersParamsFromArray( 'id' , $ids );
			$sql = " SELECT * FROM #__content_category WHERE `id` IN (" . implode( ',' , $pp[ 0 ] ) . ") AND ( " . $this->_GetFilterSql() . ") ";
			$db->Query( $sql , $pp[ 1 ] );
			return $db->Array();
		}
		public function SetFilterPublic( bool $public ): void {
			$this->_filter_public = $public;
		}
		private function _GetFilterSql(): string {
			$filter = " `public`=" . $this->_filter_public;
			return $filter;
		}
	}
?>