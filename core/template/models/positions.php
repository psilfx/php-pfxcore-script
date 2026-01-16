<?php
	defined( "exec" ) or die();

	class AppCoreTemplateModelsPositions extends Model {
		
		private array $_positions;
		private array $_positionsNamed;
		 
		public function __construct() {
			$this->_GetPositions();
			$this->_PositionData();
		}
		
		private function _GetPositions(): void {
			$db  = Cli::DB();
			$sql = 'SELECT * FROM `#__positions`';
			$db->Query( $sql );
			$this->_positions = $db->Array();
		}
		
		private function _PositionData(): void {
			foreach( $this->_positions as &$position ) {
				$position[ 'options' ] = json_decode( $position[ 'options' ] , true );
			}
		}
		
		public function GetPositions(): array {
			return $this->_positions ?? array();
		}
	}
?>