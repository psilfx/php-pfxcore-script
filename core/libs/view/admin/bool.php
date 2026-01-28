<?php defined( "exec" ) or die(); ?>
<div class="admin-field" >
	<label><?php echo $field_label; ?>
		<select name="<?php echo $field_name; ?>" >
			<?php if( (bool) $field_value ) { ?>
				<option value="1"><?php echo Lang( 'core_table_bool_1' ); ?></option>
				<option value="0"><?php echo Lang( 'core_table_bool_0' ); ?></option>
			<?php } else { ?>
				<option value="0"><?php echo Lang( 'core_table_bool_0' ); ?></option>
				<option value="1"><?php echo Lang( 'core_table_bool_1' ); ?></option>
			<?php } ?>
		</select>
	</label>
</div>