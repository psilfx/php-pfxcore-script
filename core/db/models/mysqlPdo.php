<?php
	defined( "exec" ) or die();
	
	class AppCoreDbModelsMysqlPdo extends Model {
		 
		private object $_connection;
		private bool   $_connectionsw = false;
		private object $_query;
		private bool   $_querysw = false;
		 
		public function __construct() {
			$this->_Connect();
		}
		
		private function _Connect() {
			if( $this->_connectionsw ) return;
			$this->_connection   = new PDO('mysql:host=' . _db_server . ';dbname=' . _db_db . ';charset=utf8mb4', _db_user , _db_password );
			$this->_connectionsw = true;
		}
		
		public function Close(){ //Закрыть соединение
			$this->_connection   = null;
			$this->_connectionsw = false;
		}
		
		public function Query( string $sql , array $values = array() ) { 
			$query = $this->_connection->prepare( $this->_DbPrefix( $sql ) );
			if( !$query->execute( $values ) ) return;
			$this->_query   = $query;
			$this->_querysw = true;
		}
		
		private function _DbPrefix( $sql ): string {
			return str_replace( '#__' , _db_prefix , $sql );
		}
		
		public function FetchRow(): array {
			if( !$this->_querysw ) return array();
			$this->_DropQuery(); 
			$array = $this->_query->fetch( PDO::FETCH_ASSOC );
			return ( is_array( $array ) ) ? $array : array(); 
		}
		
		public function FetchArray(): array{ 
			if( !$this->_querysw ) return array();
			$query = array();
			while( $row = $this->_query->fetch( PDO::FETCH_ASSOC ) ) {
				array_push( $query , $row );
			}
			$this->_DropQuery();
			return $query;
		}
		
		private function _DropQuery() {
			$this->_querysw = false;
		}
		
		public function CreateSqlFromArr( array $arr , string $table ): string { //Создать запрос в БД
			return ( !isset( $arr[ 'id' ] ) ) ? $this->CreateInsertQuery( $arr , $table ) : $this->CreateUpdateQuery( $arr , $table );
		}
		
		public function CreateInsertQuery( array $arr , string $table ): string {
			return "INSERT INTO `$table` ( " . implode( ', ' , array_keys( $arr ) ) . " ) VALUES( " . implode( ', ' , array_fill( 0 , count( $arr ) , '?' ) ) . " )";
		}
		
		public function CreateUpdateQuery( array $arr , string $table ): string {
			$update = array();
			foreach( $arr as $row => $value ){ //Берем значения
				if( $row == 'id' ) continue;
				$up = '`' . $row . '`=?';
				array_push( $update , $up );
			}
			$update = implode( ", " , $update );
			return "UPDATE `$table` SET $update WHERE `id` = '" . (int)$arr[ 'id' ] . "'";
		}
		
	}
?>