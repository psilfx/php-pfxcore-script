<?php
	defined( "exec" ) or die();
	
	class AppModulesContentModelsArticle extends Model {
		
		private bool $_filter_public = true;
		
		public function __construct() {

		}
		
		public function GetArticleById( int $id ): array {
			$db  = Cli::DB();
			$sql = " SELECT * FROM #__content_articles WHERE `id` = :id AND ( " . $this->_GetFilterSql() . ") ";
			$db->Query( $sql , array( ':id' => $id ) );
			return $db->Row();
		}
		public function GetArticleByName( string $name ): array {
			$db  = Cli::DB();
			$sql = " SELECT * FROM #__content_articles WHERE `name` LIKE :name AND ( " . $this->_GetFilterSql() . ") ";
			$db->Query( $sql , array( ':name' => '%' . $name . '%' ) );
			return $db->Row();
		}
		public function GetArticleCategories( int $articleId ): array {
			$db  = Cli::DB();
			$sql = " SELECT `categories_category_id` as `category_id` FROM #__content_articles_categories WHERE `article_id` = :id ";
			$db->Query( $sql , array( ':id' => $articleId ) );
			return array_column( $db->Array() , 'category_id' );
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