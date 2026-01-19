<?php
	defined( "exec" ) or die();

	class AppModulesTelegram extends Application {
		
		private object $_webhook;
		private object $_bot;
		//private object $_controller;
		//private object $_access;
		private string $_apikey = '';
		private array  $_options;
		private array  $_presetControllers;
		
		private string $_response;
		
		public function __construct( $options ) {
			$this->_options = $options;
			
		}
		public function Main() {
			$this->_GetPresets();
			$controller        = $this->_presetControllers[ (int)$this->_options[ 'controller' ] ];
			$this->_LoadModels();
			//$this->_controller = $this->_exec->Load( 'controllers' , $controller , $this->_options );
			//$this->_response   = $this->_controller->Main();
		}
		
		private function _LoadModels() {
			$webhook = $this->_exec->Load( 'models' , 'webhook' );
			$bot     = $this->_exec->Load( 'models' , 'bot' );
		}
		
		public function SetApiKey( string $apikey ): void {
			if( $this->_apikey != '' ) return;
			$this->_apikey = $apikey;
			$this->_webhook->SetApiKey( $this->_apikey );
		}
		
		public function Webhook(): object {
			return $this->_webhook;
		}
		
		public function Bot(): object {
			return $this->_bot;
		}
		
		public function LoadWebhook(): void {
			$this->_webhook = $this->_exec->Load( 'models' , 'webhook' );
		}
		public function LoadBot(): void {
			$this->_bot = $this->_exec->Load( 'models' , 'bot' );
		}
		
		private function _GetPresets() {
			$this->_presetControllers = $this->_exec->GetPreset( 'controllers' );
		}
	}
?>