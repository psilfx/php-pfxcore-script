<?php defined( "exec" ) or die(); 

	class AppCoreTemplateControllersSiteIndex extends Controller {

		public function Main() {
			$cli       = Cli::GetInstance();
			$app       = $this->_exec->App();
			$document  = $app->GetDocument();
			$positions = $app->GetPositions();
			foreach( $positions as $position ) {
				$name       = $position[ 'name' ];
				$module     = $position[ 'module' ];
				$controller = $position[ 'controller' ];
				$options    = $position[ 'options' ];
				$options   += [ 'controller' => $controller ];
				$app        = $cli->GetApp( $cli->Load( 'modules' , $module , $options ) );
				$app->Controller();
				$document->AddHTMLtoPosition( $name , $app->Response() . "\n" );
			}
			$app = Cli::Auth();
			$document->AddHTMLtoPosition( 'form' , $app->Response() . "\n" );
		}
	}
?>