<?php
	defined( "exec" ) or die();

	return array( 	'message' => 'Лосось' , 
					'keyboard' => array( [ "🤸 Секции" , "📅 Расписание" ] , [ "💳 Цены" , "✏️ Записаться" ] ) ,  
					'keyboard_inline' => array( [ [ "text" => "Узнать стоимость" , "callback_data" => "get_price" ] ] , 
												[ [ "text" => "Обсудить детали"  , "callback_data" => "details" ] ] ) ,
					'keyboard_inline_current' => 0 ,
					'keyboard_resize' => true ,
					'chat_id' => 0 ,
											
					'rewrite' => true );
?>