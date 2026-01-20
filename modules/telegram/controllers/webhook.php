<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramControllersWebhook extends Controller {
		
		public function __construct() {
		}
		
		public function Main(): string {
			$model_webhook = $this->_exec->GetObjectByAlias( 'models_webhook' );
			$model_webhook->InitFromData();
			switch ( $model_webhook->GetAction() ) {
				case "SetWebhook":
					return $model_webhook->SetWebhook();
				break;
				case "DeleteWebhook":
					return $model_webhook->DeleteWebhook();
				break;
				case "GetUpdates":
					return $model_webhook->GetUpdates();
				break;
				case "GetWebhookInfo":
					return $model_webhook->GetWebhookInfo();
				break;
				case "SendMessage":
					return $model_webhook->SendMessage();
				break;
				case "Help":
					return $model_webhook->Help();
				break;
			}
			return "";
		}
	}
?>