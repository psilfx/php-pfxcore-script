<?php defined( "exec" ) or die(); ?>
<?php
	$cli     = Cli::GetInstance();

	$tg_app  = $this->_exec->App();
	$webhook = $tg_app->Webhook();
	//Грузим бота
	$tg_bot  = $cli->GetApp( $cli->Load( 'modules' , 'telegram' , array( "controller" => 0 ) ) );
	$tg_bot->Controller();
	
	$bot     = $tg_bot->Bot();
	$bot->AddKeyboard( array( [ "🤸 Секции" , "📅 Расписание" ] , [ "💳 Цены" , "✏️ Записаться" ] ) );
	$ikeyboard1 = [ [ "text" => "Узнать стоимость" , "callback_data" => "get_price" ] ] ;
	$ikeyboard2 = [ [ "text" => "Обсудить детали"  , "callback_data" => "details" ] ] ;
	$keyboard = $bot->AddInlineKeyboard( array( $ikeyboard1 , $ikeyboard2 ) );
	$bot->SetCurrentInlineKeyboard( $keyboard );
	$bot->SetMessageText( "Test" );
	$bot->SetChatId( 0 );
	$message = $bot->CreateResponse();
	//$webhook->SendMessageToBot( $message );
?>