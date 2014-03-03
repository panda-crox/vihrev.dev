<!doctype html>
<html class="site">
<head>
	<meta charset="UTF-8">
	<title>Vihrev</title>
	<link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body class="admin">
	<form action="" method="POST" class="auth-form">
		<h3>ВХОД</h3>
		<?php if ($_SESSION['error']) : $_SESSION['error'] = false; ?>
		<p class="error">Неверные данные</p>
		<?php endif; ?>
		<p><input type="text" name="data[login]" placeholder="ЛОГИН" required></p>
		<p><input type="password" name="data[password]" placeholder="ПАРОЛЬ" required></p>
		<p><button type="submit" class="btn">ОТПРАВИТЬ</button></p>
		<input type="hidden" name="action" value="auth">
	</form>
</body>
</html>