<?php defined( "exec" ) or die(); 
	class AppCoreTemplateControllersAdminContent extends Controller {
		//Позиция вывода в шаблоне
		private string $_position;
		private object $_module;   //Отображаемый модуль
		private string $_metatitle;
		
		public function __construct( $options = array() ) {
			$this->_position = $options[ 'position' ];
		}
		
		public function Main() {
			$document = $this->_exec->App()->GetDocument();
			$routArr  = Cli::Router()->Array();
			//Данные для вывода, если не задана входная точка для модуля, выводим админку
			$response = ( !isset( $routArr[ 1 ] ) ) ? $this->_DashBoard() : $this->_DashModule( $routArr[ 1 ] , array( 'request' => $routArr ) );
			$document->SetMetadata( 'title' , $this->_metatitle );
			$document->AddHTMLtoPosition( $this->_position , $response . "\n" );
		}
		private function _DashBoard(): string {
			$this->_metatitle = Lang( 'core_admin' );
			return 'dashboard';
		}
		private function _DashModule( string $module , array $options = array() ): string {
			$cli              = Cli::GetInstance();
			$this->_module    = $cli->GetApp( $cli->Load( 'modules' , $module , $options , true ) );
			$this->_metatitle = $this->_module->GetLang( 'title' );
			$this->_module->Controller();
			return $this->_module->Response();
		}
	}
?>