<?php defined( "exec" ) or die(); 
	class AppCoreTemplateControllersAdminMenu extends Controller {
		//Позиция вывода в шаблоне
		private string $_position;
		
		public function __construct( $options = array() ) {
			$this->_position = $options[ 'position' ];
		}
		
		public function Main() {
			$app      = $this->_exec->App();
			$document = $app->GetDocument();
			$document->AddHTMLtoPosition( $this->_position , $this->_exec->GetView( 'admin' . DS . 'menu' , $app->GetModules() ) . "\n" );
		}
	}
?>