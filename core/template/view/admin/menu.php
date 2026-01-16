<?php
	defined( "exec" ) or die();
?>
<menu>
	<?php foreach( $data as $li ) { ?>
		<li>
			<span class="image" >
				<img src="<?php echo $li[ 'icon' ]; ?>" alt="<?php echo $li[ 'title' ]; ?>" />
			</span>
			<span class="title" >
				<a href="<?php echo $app->GetLink( $li[ 'module' ] ); ?>">
				</a>
				<h4><?php echo $li[ 'title' ]; ?></h4>
				<p><?php echo $li[ 'description' ]; ?></p>
			</span>
		</li>
	<?php } ?>
</menu>