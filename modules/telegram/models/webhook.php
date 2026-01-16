<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramModelsWebhook extends Model {
		
		private string $_apikey = '';
		
		public function __construct() {

		}
		
		public function SetApiKey( string $apikey ): void {
			if( $this->_apikey != '' ) return;
			$this->_apikey = $apikey;
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
		public function SendMessageToBot( array $message ): string {
			return $this->Send( 'sendMessage' , json_encode( $message ) );
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
		public function SetWebhook( string $urltoset ): string {
			return $this->Send( 'setWebHook?url=' . $urltoset );
		}
		
		public function Send( string $url , string $json = "" ): string {
			$link = $this->_GetTelegramLink( $url );
			return Cli::Curl( $link , $json );
		}
		
		private function _GetTelegramLink( $url ): string {
			return 'https://api.telegram.org/bot' . $this->_apikey . '/' . $url;
		}
		
		
	}
?>