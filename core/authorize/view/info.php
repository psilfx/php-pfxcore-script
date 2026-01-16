<?php
	defined( "exec" ) or die();
?>
<div class="user-name" >
	<div class="image"><img src="<?php echo $data[ 'image' ]; ?>" alt="" /></div>
	<div class="text">
		<p><?php echo Lang( 'core_admin_user' ); ?>:</p>
		<h3><?php echo $data[ 'name' ]; ?></h3>
	</div>
</div>
