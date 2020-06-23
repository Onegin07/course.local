<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	// проверка ввода полей
	if(isset($_POST["login"]) && isset($_POST["password"]) && $_POST["login"] != "" && $_POST["password"] != "") {
		// формируем запрос поиска в БД по имейлу и паролю
		$sql = "SELECT * FROM login WHERE login LIKE '" . $_POST["login"] . "' AND password LIKE '" . $_POST["password"] . "'";
		// выполняем запрос
		$result = mysqli_query($connect, $sql);
		// получаем количество совпадений по юзерам в БД
		$users_number = mysqli_num_rows($result);
		// если количество найденных юзеров равно 1, то авторизуем
		if($users_number == 1) {
			$user = mysqli_fetch_assoc($result); // создаем ассоциацию с юзером
			setcookie("user_id", $user["loginId"], time() + 3600); // куки для хранения на 1 час ID залогиненного юзера
			header("Location: /lessons-list.php"); // переадресация на страницу уроков
			
			// меняем статус на Онлайн
			$sql_online = "UPDATE login SET isOnline = '1' WHERE loginId =" . $user["loginId"];
			$result_online = mysqli_query($connect, $sql_online);
			$online = 1;

		} else {
			echo "<h2>Неверный логин/пароль</h2>";
		}
	}

?>

<!-- Страница входа ученика -->
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_name; ?> - Вход в систему</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	</head>
<body>
	
	<!-- Шапка сайта -->
	<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
	?>

	<div id="content">

		<div class="inout">
			<!-- Форма входа -->
			<h2>Вход в систему</h2>
			<form  id="formLogin" action="login.php" method="POST">
				<p>
					Login (email):<br/>
					<input type="text" name="login">
				</p>
				<p>
					Пароль:<br/>
					<input type="password" name="password">
				</p>
				<p>
					<button type="submit">Войти</button>
				</p>
			</form>
			<a href="register.php">Регистрация</a>
		</div>

	</div>

<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

</body>
</html>