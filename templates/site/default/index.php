<?php defined( "exec" ) or die(); ?>
<html lang="<?php echo Cli::Language(); ?>" >
<head>
<?php echo $this->HTMLHead(); ?>
</head>
	<body>
		<?php echo $this->Position( 'Telegram-Test' ); ?>
		<?php echo $this->Position( 'page-text' ); ?>
		<?php echo $this->Position( 'form' ); ?>
	</body>
</html>