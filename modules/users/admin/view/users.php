<?php defined( "exec" ) or die(); ?>
<div class="users">
	<div class="table">
		<div class="table-header">
			<div class="table-td"><?php echo Lang( 'core_table_id'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_name'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_description'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_category'); ?></div>
		</div>
	<?php foreach ( $temp_users as $user ) { ?>
		<div class="table-row">
			<div class="table-td"><?php echo $user[ 'id' ]; ?></div>
			<div class="table-td"><a href="<?php echo $user[ 'link' ]; ?>" ><?php echo $user[ 'name' ]; ?></a></div>
			<div class="table-td"><?php echo $user[ 'info' ]; ?></div>
			<div class="table-td"><?php echo $user[ 'category_name' ]; ?></div>
		</div>
	<?php } ?>
	</div>
</div>