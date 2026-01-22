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
			$this->_view = ( $count < 3 ) ? $this->_GetViewData( 'dashboard' ) : ( $count < 4 ? $this->_GetViewData( $this->_request[ 2 ] ) : '' );
		}
		private function _GetViewData( string $view ): string {
			switch ( $view ) {
				case 'dashboard' :
					$router = Cli::Router();
					$link   = $router->String();
					$links  = array( 'categories' => $link . DS . 'categories' ,
									 'users'      => $link . DS . 'users' );
					$this->_exec->WriteTempData( 'links' , $links );
				break;
				case 'categories' :
					$categoryModel = $this->_exec->GetObjectByAlias( 'models_category' );
					$categories    = $categoryModel->GetAllCategories();
					$this->_exec->WriteTempData( 'categories' , $categories );
				break;
			}
			return $view;
		}
	}
?>