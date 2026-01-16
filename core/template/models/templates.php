<?php
	defined( "exec" ) or die();

	class AppCoreTemplateModelsTemplates extends Model {
		
		private array $_settings;
		 
		public function __construct() {
			$this->_GetSettings();
		}
		
		private function _GetSettings(): void {
			$db  = Cli::DB();
			$sql = 'SELECT * FROM `#__templates`';
			$db->Query( $sql );
			$this->_settings = $db->Row();
		}
		
		public function SiteTemplate() {
			return $this->_settings[ 'site' ];
		}
		public function AdminTemplate() {
			return $this->_settings[ 'admin' ];
		}
		public function ErrorTemplate() {
			return $this->_settings[ '404' ];
		}
		public function LoadTemplateAssets( string $templateDir ): array {
			$css = Cli::FilesLib()->FilesListFromDir( $templateDir . 'css' . DS , '.css' );
			$js  = Cli::FilesLib()->FilesListFromDir( $templateDir . 'js'  . DS , '.js' );
			sort( $css );
			sort( $js );
			return array( $css , $js );
		}
	}
?>