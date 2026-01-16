<?php defined( "exec" ) or die(); 

	class AppCoreTemplateControllersRestApi extends Controller {

		public function Main(): void {
			$restvalid = Cli::Auth()->Rest();
			$document  = $this->_exec->App()->GetDocument();
			$response  = ( $restvalid ) ? $this->_LoadModuleFromJson() : '{"error": "' . Lang( 'core_invalid_token' ) . '"}';
			$document->AddHTMLtoPosition( 'api' , $response . "\n" );
		}
		private function _LoadModuleFromJson(): string {
			$cli     = Cli::GetInstance();
			$json    = LibraryData::Json();
			$module  = $json[ 'module' ];
			$options = $json[ 'options' ];
			$app     = $cli->GetApp( $cli->Load( 'modules' , $module , $options ) );
			return $app->Response();
		}
	}
?>