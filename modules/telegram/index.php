<?php
	defined( "exec" ) or die();

	class AppModulesTelegram extends Application {

		private string $_apikey = '';
		private array  $_options;
		
		public function __construct( $options ) {
			$this->_options = $options;
		}
		
		public function Main(): void {
			$this->_LoadFiles();
			$this->SetWebhookExecData( $this->_exec->GetPreset( 'webhook' ) );
			$this->SetBotExecData( $this->_exec->GetPreset( 'bot' ) );
		}
		
		private function _LoadFiles(): void {
			$this->_exec->Load( 'models' , 'webhook' , $this->_options );
			$this->_exec->Load( 'models' , 'bot' , $this->_options );
			$this->_exec->Load( 'controllers' , 'webhook' );
			$this->_exec->Load( 'controllers' , 'bot' );
		}
		
		public function SetWebhookExecData( array $data ): void {
			$this->_exec->WriteTempData( 'data_webhook' , $data );
		}
		public function SetBotExecData( array $data ): void {
			$this->_exec->WriteTempData( 'data_bot' , $data );
		}
	}
?>