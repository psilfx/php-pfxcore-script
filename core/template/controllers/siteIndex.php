<?php defined( "exec" ) or die(); 

	class AppCoreTemplateControllersSiteIndex extends Controller {

		public function Main(): string {
			$cli       = Cli::GetInstance();
			$app       = $this->_exec->App();
			$document  = $app->GetDocument();
			$positions = $app->GetPositions();
			$handlers  = _root_dir .DS . $app->GetTemplatePath() . 'handlers' . DS;
			foreach( $positions as $position ) {
				$name       = $position[ 'name' ];
				$module     = $position[ 'module' ];
				$controller = $position[ 'controller' ];
				$options    = $position[ 'options' ];
				$handler    = $handlers . $name . '.php';
				$options   += [ 'controller' => $controller ];
				$app        = $cli->GetApp( $cli->Load( 'modules' , $module , $options ) );
				$app->TemplateHandler( $handler );
				$app->Controller();
				$document->AddHTMLtoPosition( $name , $app->Response() . "\n" );
			}
			$app = Cli::Auth();
			$document->AddHTMLtoPosition( 'form' , $app->Response() . "\n" );
			return "";
		}
	}
?>