<?php
	defined( "exec" ) or die();

	class AppCoreTemplate extends Application {
		
		private object $_templates;    //Модель информации о шаблонах
		private object $_positions;    //Модель вывода позиций в шаблоне
		private object $_modules;      //Модель вывода модулей
		private object $_document;     //Выводимы документ
		private object $_loader;       //Контроллер загрузки
		
		public function __construct( array $options = array() ) {
		}
		public function Main(): void {
			( Cli::Router()->RestApi() ) ? $this->_LoadRestApi() : $this->_LoadTemplate();
		}
		
		private function _LoadRestApi(): void {
			$this->_document     = $this->_exec->Load( 'models'      , 'document' );
			$this->_templatepath = 'templates' . DS . 'rest' . DS;
		}
		
		private function _LoadTemplate(): void {
			$this->_templates    = $this->_exec->Load( 'models'      , 'templates' );
			$this->_positions    = $this->_exec->Load( 'models'      , 'positions' );
			$this->_modules      = $this->_exec->Load( 'models'      , 'modules' );
			$this->_document     = $this->_exec->Load( 'models'      , 'document' );
			$this->_loader       = $this->_exec->Load( 'controllers' , 'loader' );
			$this->_loader->Main();
		}
		
		private function _AddTemplateAssetsToDocument(): void {
			$cssJs = $this->_templates->LoadTemplateAssets( $this->_templatepath );
			$this->_document->AddCss( $cssJs[ 0 ] );
			$this->_document->AddJs(  $cssJs[ 1 ] );
		}
		
		public function AddCss( array $css ): void {
			$this->_document->AddCss( $css );
		}
		
		public function AddJs( array $js ): void {
			$this->_document->AddCss( $js );
		}

		public function View(): string {
			return $this->_document->View( _root_dir .DS . $this->GetTemplatePath() . 'index.php' );
		}
		
		public function GetDocument(): object {
			return $this->_document;
		}
		
		public function GetPositions(): array {
			return $this->_positions->GetPositions();
		}
		
		public function GetLink( string $link = '' ): string {
			return $this->_loader->Link() . $link;
		}
		
		public function GetModules(): array {
			return $this->_modules->GetModules();
		}
		public function GetTemplates(): object {
			return $this->_templates;
		}
		public function GetTemplatePath(): string {
			return $this->_loader->TemplatePath();
		}
		
		public function Response(): string {
			return $this->View();
		}
	}
?>