<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramModelsWebhook extends Model {
		
		private string $_api_key        = '';
		private string $_webhook_url    = '';
		private string $_webhook_action = '';
		private string $_bot_message    = '';
		
		public function __construct() {

		}
		
		public function SetApiKey( string $_api_key ): void {
			if( $this->_api_key != '' ) return;
			$this->_api_key = $_api_key;
		}
		public function SetWebhookUrl( string $url ): void {
			$this->_webhook_url = $url;
		}
		public function SetWebhookAction( string $action ): void {
			$this->_webhook_action = $action;
		}
		public function SetBotMessage( string $bot_json ): void {
			$this->_bot_message = $bot_json;
		}
		public function GetAction() {
			return $this->_webhook_action;
		}
		/**
		 ** @desc Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object.
		 **/
		public function GetWebhookInfo(): string {
			return $this->Send( 'getWebhookInfo' );
		}
		/**
		 ** @desc Use this method to receive incoming updates using long polling (wiki). Returns an Array of Update objects.
		 **/
		public function GetUpdates(): string {
			return $this->Send( 'getUpdates' );
		}
		//Для использования из вне
		public function SendMessageToBot( array $message ): string {
			return $this->Send( 'sendMessage' , json_encode( $message ) );
		}
		//Для использования через action
		public function SendMessage(): string {
			return $this->Send( 'sendMessage' , $this->_bot_message );
		}
		/**
		 ** @desc Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
		 **/
		public function DeleteWebhook(): string {
			return $this->Send( 'deleteWebhook' );
		}
		/**
		 ** @desc Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL
		 **/
		public function SetWebhook(): string {
			return $this->Send( 'setWebHook?url=' . $this->_webhook_url );
		}
		public function Help(): string {
			return 'Пресет, webhook, ключ - action: SetWebhook | DeleteWebhook | GetUpdates | GetWebhookInfo | sendMessage';
		}
		/**
		 ** @desc Для обращения из вне, отправляем json
		 **/
		public function Send( string $url , string $json = "" ): string {
			$link = $this->_GetTelegramLink( $url );
			return Cli::Curl( $link , $json );
		}
		
		private function _GetTelegramLink( $url ): string {
			return 'https://api.telegram.org/bot' . $this->_api_key . '/' . $url;
		}
		public function InitFromData() {
			$data_webhook = $this->_exec->ReadTempData( 'data_webhook' );
			$this->SetApiKey( $data_webhook[ 'api_key' ] );
			$this->SetWebhookUrl( $data_webhook[ 'webhook_url' ] );
			$this->SetWebhookAction( $data_webhook[ 'action' ] );
			$this->SetBotMessage( $data_webhook[ 'bot_message' ] );
		}
		
	}
?>