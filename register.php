<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	if(
	isset($_POST["email"]) && isset($_POST["password"])
	&& $_POST["email"] != "" && $_POST["password"] != ""
) {
		//$password = md5($_POST["password"]);
	$sql = "INSERT INTO login (login, password, FirstName, LastName, photo, phone) VALUES ('" . $_POST["email"] . "','" . $_POST["password"] . "', '" . $_POST["first_name"] . "','" . $_POST["last_name"] . "', '" . $_POST["photo"] . "', '" . $_POST["phone"] . "')";
	if(mysqli_query($connect, $sql)) {
		header("Location: /login.php");
	}
}
?>

<!-- Страница регистрации ученика -->
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_name; ?> - Регистрация</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	</head>
<body>
	
	<!-- Шапка сайта -->
	<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
	?>
<div id="content">
	<form enctype="multipart/form-data" action="register.php" method="POST">
	<p>First name<br/>
	<input type="text" name="first_name">
	</p>
	<p>Last name<br/>
	<input type="text" name="last_name">
	</p>
	<p>Email<br/>
	<input type="text" name="email">
	</p>
	<p>Password<br/>
	<input type="password" name="password">
	</p>
	<p>Phone<br/>
	<input type="text" name="phone">
	</p>
	<select name="photo">
		<option value="/images/user-default.png">Цвет аватара</option>
        <option style="color: #a6ce28;" value="images/user-green.png">Зеленый</option>
        <option style="color: #666aff;" value="images/user-blue.png">Синий</option>
        <option style="color: #ea5252;" value="images/user-red.png">Красный</option>
        <option style="color: #ff9800;" value="images/user-orange.png">Оранжевый</option>
    </select>
	<button type="submit">Регистрация</button>
</form>
</div>


</body>
</html>