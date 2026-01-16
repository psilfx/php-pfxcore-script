<?php
	defined( "exec" ) or die();

	class LibraryFiles {
		public static function FilesListFromDir( string $dir , string $extension = '' ): array {
			return glob( $dir . '*' . $extension ) ?? array();
		}
		public static function DirsListFromDir( string $dir ): array {
			return glob( $dir . '*' , GLOB_ONLYDIR ) ?? array();
		}
		public static function FilesNamesFromDir( string $dir ): array {
			return array_map( 'basename' , self::FilesListFromDir( $dir )  );
		}
		public static function DirsNamesFromDir( string $dir ): array {
			return array_map( 'basename' , self::DirsListFromDir( $dir )  );
		}
	}
?>