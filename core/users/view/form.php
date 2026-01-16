<?php
	defined( "exec" ) or die();
?>
<style>
	

	
</style>
<div class="form-container block">
	<form id="loginForm">
		<div class="input-group">
			<label for="username">Имя пользователя</label>
			<input type="text" id="username" name="username" required placeholder="Введите ваш логин">
		</div>
		<div class="input-group">
			<label for="password">Пароль</label>
			<input type="password" id="password" name="password" required placeholder="Введите ваш пароль">
		</div>
		<div class="form-button">
			<button type="submit" class="login-button">Войти</button>
		</div>
	</form>
</div>
