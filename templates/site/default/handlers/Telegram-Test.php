<?php defined( "exec" ) or die(); ?>
<?php
	$db  = Cli::DB();
	$sql = " SELECT * FROM `#__users_category` ";
	$db->Query( $sql , array() );
	$row = $db->Row();
	
	$admin = Cli::AdminLib();
	echo $admin->DBFieldsToHTML( $row );
?>