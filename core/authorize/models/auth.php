<?php
	defined( "exec" ) or die();
	
	class AppCoreAuthorizeModelsAuth extends Model {
		//Хранит объект базы данных, т.к. бд используется в разных методах
		private object $_users;
		 
		public function __construct() {
			$this->_users = Cli::Users();
		}
		public function GetUserFromDbByName( string $name ): array {
			return $this->_users->GetUserByName( $name );
		}
		public function GetUserFromDbById( int $id ): array {
			return $this->_users->GetUserById( $id );
		}
	}
?>