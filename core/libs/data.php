<?php
	defined( "exec" ) or die();

	class LibraryData extends Library {
		
		public static function Post(): array {
			return $_POST;
		}
		public static function Get(): array {
			return $_GET;
		}
		public static function Json(): array {
			$json = file_get_contents( 'php://input' ) ?? '{}';
			return json_decode( $json , true );
		}
	}
?>