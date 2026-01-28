<?php
	defined( "exec" ) or die();

	class LibraryAdmin extends Library {
		public function DBFieldsToHTML( array $fields , array $types = array() ): string {
			$html = '';
			foreach( $fields as $name => $field ) {
				$html .= $this->DBFieldToHTML( array( 'label' => $name , 'name' => $name , 'value' => $field ) , $types[ $name ] ?? 'string' );
			}
			return $html;
		}
		public function DBFieldToHTML( array $field , string $type = 'string' ): string {
			return $this->GetView( $type , $field );
		}
	}
?>