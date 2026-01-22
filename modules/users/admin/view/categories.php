<?php
	defined( "exec" ) or die();
?>
<div class="users">
	<?php foreach ( $temp_categories as $category ) { ?>
	<table>
		<td><?php echo $category[ 'id' ]; ?></td>
		<td><?php echo $category[ 'name' ]; ?></td>
		<td><?php echo $category[ 'description' ]; ?></td>
		<td><?php echo $category[ 'admin' ]; ?></td>
		<td><?php echo $category[ 'permission_create' ]; ?></td>
		<td><?php echo $category[ 'permission_edit' ]; ?></td>
	</table>
	<?php } ?>
</div>