<?php
	defined( "exec" ) or die();
	
	class AppCoreDbModelsMysql extends Model {
		 
		private object $_connection;
		private bool   $_connectionsw = false;
		private object $_query;
		private bool   $_querysw = false;
		 
		public function __construct() {
			$this->_Connect();
		}
		
		private function _Connect() {
			if( $this->_connectionsw ) return;
			$this->_connection   = new mysqli( _db_server , _db_user , _db_password , _db_db );
			$this->_connectionsw = true;
			$this->_connection->set_charset( 'utf8' );
		}
		
		public function Close(){ //Закрыть соединение
			$this->_connection->close();
			$this->_connectionsw = false;
		}
		
		public function Query( $sql ){ 
			$query = $this->_connection->query( $this->_DbPrefix( $sql ) );
			if( !is_object( $query ) ) return;
			$this->_query   = $query;
			$this->_querysw = true;
		}
		
		private function _DbPrefix( $sql ): string {
			return str_replace( '#__' , _db_prefix , $sql );
		}
		
		public function FetchRow(): array {
			if( !$this->_querysw ) return array();
			$this->_DropQuery();
			return $this->_query->fetch_assoc(); 
		}
		
		public function FetchArray(): array{ 
			if( !$this->_querysw ) return array();
			$query = array();
			while( $row = $this->_query->fetch_assoc() ){
				array_push( $query , $row );
			}
			$this->_DropQuery();
			return $query;
		}
		
		private function _DropQuery() {
			$this->_querysw = false;
		}
		
		public function CreateSqlFromArr( array $arr , string $table ): string { //Создать запрос в БД
			$rows   = array();
			$values = array();
			$sql    = "";
			//Insert
			if( empty( $arr[ 'id' ] ) ){
				foreach( $arr as $row => $value ){ //Берем значения
					array_push( $rows , '`' . $row . '`' );
					array_push( $values , $value );
				}
				$rows   = implode( ',' , $rows );
				$values = '\'' . implode( '\', \'' , $values ) . '\'';
				$sql    = "INSERT INTO `$table` ($rows) VALUES($values)";
			} else { //Update
				$update = array();
				foreach( $arr as $row => $value ){ //Берем значения
					if( $row == 'id' ) continue;
					$up = '`' . $row . '`=\'' . $value . '\'';
					array_push( $update , $up );
				}
				$update = implode( ", " , $update );
				$sql    = "UPDATE `$table` SET $update WHERE `id` = '" . $arr['id'] . "'";
			}
			return $sql;
		}
		
	}
?>