<?php
	defined( "exec" ) or die();
	
	class AppModulesTelegramModelsBot extends Model {
		//Клавиатуры основные
		private array $_keyboards          = [];
		//Клавиатуры внутри поля
		private array $_keyboards_inline   = [];
		private int $_keyboardi_current    = 0;
		//Для растягивания кнопок под размер экрана
		private bool $_keyboard_resize     = true;
		//Текст ответа
		private string $_message_text      = "";
		//Ответ
		private array $_response           = [];
		//Id чата для отправки сообщения
		private int $_chat_id              = 0;
		
		public function __construct() {

		}
		
		public function AddKeyboard( array $items ): void {
			$this->_keyboards = $items;
		}
		public function AddInlineKeyboard( array $items ): int {
			$key                             = count( $this->_keyboards_inline );
			$this->_keyboards_inline[ $key ] = $items;
			$this->_keyboardi_current++;
			return $key;
		}
		public function SetMessageText( string $text ): void {
			$this->_message_text = $text;
		}
		public function SetChatId( int $id ): void {
			$this->_chat_id = $id;
		}
		public function SetCurrentInlineKeyboard( int $key ): void {
			if( isset( $this->_keyboards_inline[ $key ] ) ) $this->_keyboardi_current = $key;
		}
		public function SetKeyboardResize( bool $val ): void {
			$this->_keyboard_resize = $val;
		}
		public function CreateResponse(): array {
			$inline_keyboard = $this->_keyboards_inline[ $this->_keyboardi_current ];
			$reply_markup    = array( 
										"inline_keyboard" => $inline_keyboard , 
										"keyboard"        => $this->_keyboards , 
										"resize_keyboard" => $this->_keyboard_resize 
									);
			$this->_response = array( 
										"chat_id"      => $this->_chat_id , 
										"text"         => $this->_message_text , 
										"parse_mode"   => "markdown" , 
										"reply_markup" => $reply_markup 
									);
			return $this->_response;
		}
		public function InitFromData() {
			$data_bot = $this->_exec->ReadTempData( 'data_bot' );
			$keyboard = $this->AddInlineKeyboard( $data_bot[ 'keyboard_inline' ] );
			$this->AddKeyboard( $data_bot[ 'keyboard' ] );
			$this->SetCurrentInlineKeyboard( $keyboard );
			$this->SetKeyboardResize( $data_bot[ 'keyboard_resize'] );
			$this->SetMessageText( $data_bot[ 'message'] );
			$this->SetChatId( $data_bot[ 'chat_id'] );
		}
		public function SendMessageToBot( object $webhook ): string {
			return $webhook->SendMessageToBot( $this->CreateResponse() );
		}
	}
?>