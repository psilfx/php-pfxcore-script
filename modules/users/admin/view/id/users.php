<?php defined( "exec" ) or die(); ?>
<?php $admin = Cli::AdminLib(); ?>
<div class="users">
	<div class="table">
		<div class="table-header">
			<div class="table-td"><?php echo Lang( 'core_table_view'); ?></div>
			<div class="table-td"><?php echo Lang( 'core_table_settings'); ?></div>
		</div>
		<div class="table-row">
			<div class="table-td">
				<?php 
					echo $admin->DBFieldToHTML( array( 
														'label' => Lang( 'core_table_name' ) . ':' , 
														'name' => 'name' , 
														'value' => $temp_id[ 'name' ] , 
														'placeholder' => Lang( 'core_table_name' ) 
													) 
												); 
					echo $admin->DBFieldToHTML( array( 
														'label' => Lang( 'core_table_description' ) . ':' , 
														'name' => 'info' , 
														'value' => $temp_id[ 'info' ] , 
														'placeholder' => Lang( 'core_table_description' ) 
														) , 
														'textarea' 
												); 
				?>
			</div>
			<div class="table-td">
				<?php
					echo $admin->DBFieldToHTML( array( 
														'label' => Lang( 'core_table_admin' ) . ':' , 
														'name' => 'admin' , 
														'value' => $temp_id[ 'admin' ] , 
														'placeholder' => Lang( 'core_table_admin' ) 
														) , 
														'bool' 
												);
					echo $admin->DBFieldToHTML( array( 
														'label' => $exec->Lang( 'permission_create') . ':' , 
														'name' => 'permission_create' , 
														'value' => $temp_id[ 'permission_create' ] , 
														'placeholder' => $exec->Lang( 'permission_create') 
														) , 
														'bool' 
												);
					echo $admin->DBFieldToHTML( array( 
														'label' => $exec->Lang( 'permission_edit') . ':' , 
														'name' => 'permission_edit' , 
														'value' => $temp_id[ 'permission_edit' ] , 
														'placeholder' => $exec->Lang( 'permission_edit') 
														) , 
														'bool' 
												);
				?>
			</div>
		</div>
	</div>
</div>