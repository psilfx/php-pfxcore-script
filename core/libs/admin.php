<?php
	defined( "exec" ) or die();

	class LibraryAdmin extends Library {
		public function DBFieldsToHTML( array $fields , array $types = array() ): string {
			$html = '';
			foreach( $fields as $name => $field ) {
				$view  = $types[ $name ] ?? 'string';
				$html .= $this->GetView( $view , array( 'label' => $name , 'name' => $name , 'value' => $field ) );
			}
			return $html;
		}
	}
?>