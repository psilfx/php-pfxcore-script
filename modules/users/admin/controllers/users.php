<?php
	defined( "exec" ) or die();

	class AppModulesUsersAdminControllersUsers extends Controller {
		
		private array  $_request;
		private string $_view; //Шаблон вывода
		
		public function __construct( array $options = array() ) {
			$this->_request = $options[ 'request' ];
		}
		public function Main(): string {
			$this->_GetView();
			return $this->_exec->GetView( $this->_view );
		}
		private function _GetView(): void {
			$count       = count( $this->_request );
			$view        = ( $count < 3 ) ? 'dashboard' : ( $count < 4 ? $this->_request[ 2 ] : _id . DS . $this->_request[ 2 ] );
			$this->_view = $this->_GetViewData( $view );
		}
		private function _GetViewData( string $view ): string {
			$router = Cli::Router();
			$link   = $router->String();
			switch ( $view ) {
				case 'dashboard' :
					$links  = array( 'categories' => $link . DS . 'categories' ,
									 'users'      => $link . DS . 'users' );
					$this->_exec->WriteTempData( 'links' , $links );
				break;
				case 'categories' :
					$categoryModel = $this->_exec->GetObjectByAlias( 'models_category' );
					$categories    = $categoryModel->GetAllCategories();
					foreach( $categories as &$category ) {
						$category[ 'link' ] = $link . DS . 'id-' . $category[ 'id' ];
					}
					$this->_exec->WriteTempData( 'categories' , $categories );
				break;
				case 'users' :
					$userModel = $this->_exec->GetObjectByAlias( 'models_user' );
					$users     = $userModel->GetAllUsers();
					foreach( $users as &$user ) {
						$user[ 'link' ] = $link . DS . 'id-' . $user[ 'id' ];
					}
					$this->_exec->WriteTempData( 'users' , $users );
				break;
				case 'id' . DS . 'users' :
					$userModel = $this->_exec->GetObjectByAlias( 'models_user' );
					$id        = $router->IdNum();
					$user      = $userModel->GetUserFromDbById( $id );
					$this->_exec->WriteTempData( 'id' , $user );
				break;
				case 'id' . DS . 'categories' :
					$categoryModel = $this->_exec->GetObjectByAlias( 'models_category' );
					$id            = $router->IdNum();
					$category      = $categoryModel->GetCategoryById( $id );
					$this->_exec->WriteTempData( 'id' , $category );
				break;
			}
			return $view;
		}
	}
?>