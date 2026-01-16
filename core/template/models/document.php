<?php
	defined( "exec" ) or die();

	class AppCoreTemplateModelsDocument extends Model {
		
		private array $_js;
		private array $_css;
		private array $_html;
		private array $_positions;
		private array $_metadata;
		 
		public function __construct() {
			$this->_positions = array();
			$this->_js        = array();
			$this->_css       = array();
			$this->_metadata  = array();
			$this->SetMetadata( 'title'       , 'Не задано' );
			$this->SetMetadata( 'charset'     , 'utf-8' );
			$this->SetMetadata( 'keywords'    , '' );
			$this->SetMetadata( 'description' , '' );
		}
		
		public function View( string $path ): string {
			return require_once( $path ); 
		}
		
		public function AddJs( array $js ) {
			foreach( $js as $file ) {
				$this->_js[] = $file;
			}
		}
		public function AddCss( array $css ) {
			foreach( $css as $file ) {
				$this->_css[] = $file;
			}
		}
		
		public function AddTemplateAssets() {
			$app   = $this->_exec->App();
			$path  = $app->GetTemplatePath();
			$cssJs = $app->GetTemplates()->LoadTemplateAssets( $path );
			$this->AddCss( $cssJs[ 0 ] );
			$this->AddJs(  $cssJs[ 1 ] );
		}
		
		public function SetMetadata( string $key , string $data ): void {
			$this->_metadata[ $key ] = $data;
		}
		
		public function Position( string $positionName ): string {
			$html = "";
			foreach( $this->_positions[ $positionName ] as $positionHtml ) {
				$html .= $positionHtml;
			}
			return $html;
		}
		public function AddHTMLtoPosition( string $positionName , string $positionHtml ): void {
			$this->CreatePosition( $positionName );
			$this->_positions[ $positionName ][] = $positionHtml;
		}
		public function CreatePosition( string $positionName ): void {
			( !isset( $this->_positions[ $positionName ] ) ) ? $this->_positions[ $positionName ] = array() : $this->_positions[ $positionName ];
		}
		public function HTMLHead() {	
			$html  = "	" . '<title>' . $this->_metadata[ 'title' ] . '</title>' . "\n";
			$html .= "	" . '<meta charset="' . $this->_metadata[ 'charset' ] . '">' . "\n";
			$html .= "	" . '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
			$html .= "	" . '<meta name="description" content="' . $this->_metadata[ 'description' ] . '">' . "\n";
			$html .= "	" . '<meta name="keywords" content="' . $this->_metadata[ 'keywords' ]    . '">' . "\n";
			$html .= "	" . '<base href="/">' . "\n";
			foreach( $this->_css as $css ) {
				$html .= "	" . '<link rel="stylesheet" href="' . $css . '" >' . "\n";
			}
			foreach( $this->_js as $js ) {
				$html .= "	" . '<script src="' . $js . '" ></script>' . "\n";
			}
			return $html;
		}
	}
?>