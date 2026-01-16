<?php
	defined( "exec" ) or die();

	class AppCoreTemplateModelsModules extends Model {
		
		public function __construct() {

		}
		
		public function GetModules( string $destination = 'modules' ): array {
			$list    = Cli::FilesLib()->DirsNamesFromDir( _root_dir . DS . $destination . DS );
			$modules = array();
			foreach( $list as $name ) {
				$info = Cli::GetAppInfo( $destination , $name );
				if( !empty( $info ) ) array_push( $modules , $info );
			}
			return $modules;
		}
	}
?>