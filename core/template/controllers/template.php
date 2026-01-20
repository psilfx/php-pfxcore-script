<?php
	defined( "exec" ) or die();
	
	class AppCoreTemplateControllersTemplate extends Controller {
		
		private object $_templateController; //Контроллер шаблона
		private string $_templatepath;       //Путь к шаблону
		
		public function Main(): string {
			$router   = Cli::Router();
			$app      = $this->_exec->App();
			$document = $app->GetDocument();
			if( $router->RestApi() ) {
				$this->_templateController = $this->_exec->Load( 'controllers' , 'restApi' );
				$this->_templatepath       = 'templates' . DS . 'rest' . DS;
			} else {
				
				$this->_templateController = $this->_LoadTemplateController( $router->Admin() );
				$this->_templatepath       = $this->_LoadTemplatePath( $router , $app->GetTemplates() );
				$document->AddTemplateAssets();
			}
			$this->_templateController->Main();
			return $document->View( _root_dir .DS . $this->_templatepath . 'index.php' );
		}
		
		/**
		 ** @desc Проверяет, является ли запрос в админку
		 **/
		private function _LoadTemplatePath( object $router , object $templates ): string {
			if( $router->Admin() ) return 'templates' . DS . 'admin' . DS . $templates->AdminTemplate() . DS ;
			return 'templates' . DS . 'site' . DS. $templates->SiteTemplate() . DS ;
		}
		/**
		 ** @desc Грузим контроллер шаблона, либо сайт, либо админку
		 **/
		private function _LoadTemplateController( bool $admin ): object {
			if( $admin ) return $this->_exec->Load( 'controllers' , 'adminIndex' );
			return $this->_exec->Load( 'controllers' , 'siteIndex' );
		}
		
		public function TemplatePath() {
			return $this->_templatepath;
		}
		public function Link():string {
			return $this->_templateController->Link();
		}
		
	}
?>