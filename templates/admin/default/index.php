<?php defined( "exec" ) or die(); ?>
<!DOCTYPE html>
<html lang="ru" >
	<head>
		<?php echo $this->HTMLHead(); ?>
	</head>
	<body class="<?php echo $this->Position( 'output' ); ?>" >
		<div class="grid">
			<header class="header">
				<?php echo $this->Position( 'header' ); ?>
			</header>
			<div class="sidebar">
				<?php echo $this->Position( 'sidebar' ); ?>
			</div>
			<div class="content">
				<?php echo $this->Position( 'content' ); ?>
			</div>
			<footer class="footer">
				<?php echo $this->Position( 'footer' ); ?>
			</footer>
		</div>
	</body>
</html>