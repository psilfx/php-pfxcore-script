<?php
	defined( "exec" ) or die();

	class LibraryArrays {
		public static function CheckBool( string $key , array $arr ): bool {
			return ( isset( $arr[ $key ] ) ) ? 1 : 0;
		}
		public static function Val( string $key , array $arr ) {
			return ( isset( $arr[ $key ] ) ) ? $arr[ $key ] : null;
		}
	}
?>