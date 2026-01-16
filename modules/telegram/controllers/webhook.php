<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersWebhook extends Controller {
		
		private string $_apikey;
		private string $_action;
		private array  $_options;
		
		public function __construct( array $options = array() ) {
			$this->_apikey  = $options[ 'api-key' ];
			$this->_action  = $options[ 'action' ] ?? null;
			$this->_options = &$options;
		}
		
		public function Main(): string {
			$app = $this->_exec->App();
			$app->LoadWebhook();
			$app->SetApiKey( $this->_apikey );
			return $this->_Action( $app->Webhook() );
		}
		
		private function _Action( $webhook ): string {
			switch ( $this->_action ) {
				case "SetWebhook":
					return $webhook->SetWebhook( $this->_options[ 'url' ] );
				break;
				case "DeleteWebhook":
					return $webhook->DeleteWebhook();
				break;
				case "GetUpdates":
					return $webhook->GetUpdates();
				break;
				case "GetWebhookInfo":
					return $webhook->GetWebhookInfo();
				break;
			}
		}
	}
?>