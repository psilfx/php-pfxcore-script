<?php
	defined( "exec" ) or die();
	
	class AppCoreUsersModelsUser extends Model {
		//Хранит объект базы данных, т.к. бд используется в разных методах
		private object $_db;
		//Sql запрос на получения данных пользователя, используется с подставленным условием поиска
		private string $_userSql;
		 
		public function __construct() {
			$this->_db      = Cli::DB();
			$this->_userSql = " SELECT 	u.*,
										c.name  	  AS category_name, 
										c.id          AS category_id,
										c.description AS category_description,
										c.admin 	  AS admin,
										c.permission_create,
										c.permission_edit
								FROM		 `#__users`          u 
								INNER JOIN 	 `#__users_category` c 
								ON		`u`.`category` = `c`.`id` ";
		}
		
		public function GetUserFromDbByName( string $name ): array {
			return $this->_DoRequest( $this->_userSql . "WHERE `u`.`name` = :name " , array( ':name' => $name ) );
		}
		public function GetUserFromDbById( int $id ): array {
			return $this->_DoRequest( $this->_userSql . "WHERE `u`.`id` = :id " , array( ':id' => $id ) );
		}
		private function _DoRequest( string $sql , array $values = array() ): array {
			$this->_db->Query( $sql , $values );
			return $this->_db->Row();
		}
	}
?>