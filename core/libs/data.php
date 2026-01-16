<?php
	defined( "exec" ) or die();

	class LibraryData {
		
		public static function Post() {
			print_r( $_POST );
		}
		public static function Get() {
			
		}
		public static function Json() {
			$json = file_get_contents( 'php://input' ) ?? '{}';
			return json_decode( $json , true );
		}
	}
?>