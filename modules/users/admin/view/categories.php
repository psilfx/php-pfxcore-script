<?php defined( "exec" ) or die(); ?>
<div class="users">
	<div class="table">
		<div class="table-header">
			<div class="table-td"><?php echo Lang( 'core_table_id'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_name'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_description'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_admin'); ?></div>
			<div class="table-td"><?php echo $exec->Lang( 'permission_create'); ?></div>
			<div class="table-td"><?php echo $exec->Lang( 'permission_edit'); ?></div>
		</div>
	<?php foreach ( $temp_categories as $category ) { ?>
		<div class="table-row">
			<div class="table-td"><?php echo $category[ 'id' ]; ?></div>
			<div class="table-td"><a href="<?php echo $category[ 'link' ]; ?>" ><?php echo $category[ 'name' ]; ?></a></div>
			<div class="table-td"><?php echo $category[ 'description' ]; ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_bool_' . $category[ 'admin' ] ); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_bool_' . $category[ 'permission_create' ] ); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_bool_' . $category[ 'permission_edit' ] ); ?></div>
		</div>
	<?php } ?>
	</div>
</div>