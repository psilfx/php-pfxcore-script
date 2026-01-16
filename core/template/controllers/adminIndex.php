<?php defined( "exec" ) or die(); 
	class AppCoreTemplateControllersAdminIndex extends Controller {
		private object $_menu;
		private object $_content;
		private string $_link;
		
		public function __construct() {
			$this->_link = DS . _administrator . DS;
		}
		public function Main() {
			$app      = $this->_exec->App();
			$document = $app->GetDocument();
			$auth     = Cli::Auth();
			if( $auth->Admin() ) {
				$this->_LoadContent( $document , $auth->Response() );
			} else {
				$this->_LoadForm( $document , $auth->Response() );
			} 
		}
		private function _LoadForm( object $document , string $response ): void {
			$document->AddHTMLtoPosition( 'header'  , '<h1 class="block-header">' . Lang( 'core_admin_welcome' ) . '</h1>' . "\n" );
			$document->AddHTMLtoPosition( 'header'  , '<h3 class="block-sub-header">' . Lang( 'core_admin_welcome_desc' ) . '</h3>' . "\n" );
			$document->AddHTMLtoPosition( 'sidebar' , '' . "\n" );
			$document->AddHTMLtoPosition( 'content' , $response . "\n" );
			$document->AddHTMLtoPosition( 'footer'  , '<p class="block-sub-header">' . Lang( 'core_admin_copyright' ) . date( 'Y' ) . '</p>' . "\n" );
			$document->AddHTMLtoPosition( 'output'  , 'output-form' );
		}
		private function _LoadContent( object $document , string $response ): void {
			$this->_LoadContentMenu();
			$this->_LoadContentContent();
			$header  = '<div class="header-top-panel">';
			$header .= '<div class="logo"><img src="' . DS . 'core' . DS . 'assets' . DS . 'images' . DS . 'logo.png' . '" alt="Логотип" /> <h3>' . Lang( 'core_cms_name' ) . '</h3></div>';
			$header .= '<h1 class="block-header">' . Lang( 'core_admin_welcome' ) . '</h1>' . "\n";
			$header .= $response;
			$header .= '</div>';
			$document->AddHTMLtoPosition( 'header'  , $header . "\n" );
			$document->AddHTMLtoPosition( 'footer'  , '<p class="block-sub-header">' . Lang( 'core_admin_copyright' ) . date( 'Y' ) . '</p>' . "\n" );
			$document->AddHTMLtoPosition( 'output'  , 'output-content' );
		}
		private function _LoadContentMenu(): void {
			$this->_menu = $this->_exec->Load( 'controllers' , 'adminMenu' , array( 'position' => 'sidebar' ) );
			$this->_menu->Main();
		}
		private function _LoadContentContent(): void {
			$this->_content = $this->_exec->Load( 'controllers' , 'adminContent' , array( 'position' => 'content' ) );
			$this->_content->Main();
		}
		public function Link(): string {
			return $this->_link;
		}
	}
?>