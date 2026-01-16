<?php
	defined( "exec" ) or die();
	
	/**
	 ** @desc Абстрактный класс контроллера
	 ** @author PsilFX
	 **/
	abstract class Controller extends Model {
		
		abstract function Main();
	}
?>