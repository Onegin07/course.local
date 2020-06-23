<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	// маркер для главного меню
    $page = "profile";
    
    // делаем проверку если заполнены поля email & password и нету пустот в данных полях то делаем запрос на изменения данных авторизированого профиля
	if(
	isset($_POST["email"]) && isset($_POST["password"])&& $_POST["email"] != "" && $_POST["password"] != "") {
			$sql = "UPDATE `login` SET `FirstName` = '" . $_POST["first_name"] . "', `LastName` = '" . $_POST["last_name"] .  "' , `phone` = '" . $_POST["phone"] .  "', `password` = '" . $_POST["password"] .  "', `login` = '" . $_POST["email"] .  "' WHERE `login`.`loginId` =" . $_COOKIE["user_id"];
     $result = mysqli_query($connect, $sql);
     header("Location: /profile.php");
	} //else {
		//echo "Поля Password & Email обязательны к заполнению";
	//}
    // делаем запрос на вывод данных для заполнения полей авторизированого профиля
	$sql = "SELECT * FROM login WHERE loginId=" . $_COOKIE["user_id"];
    $register = mysqli_fetch_assoc( $connect->query($sql) );
                                    
?>

<!-- Страница регистрации ученика -->
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_name; ?> - Профиль</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	</head>
<body>
	
	<!-- Шапка сайта -->
	<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
	?>

<div id="content" class="main">
	<div class="inout">
		<h2>Изменить профиль</h2>
		<form method="POST">
			<p>Имя<br/>
			<input type="text" name="first_name" value="<?php echo $register['FirstName']; ?>">
			</p>
			<p>Фамилия<br/>
			<input type="text" name="last_name" value="<?php echo $register['LastName']; ?>">
			</p>
			<p>Email<br/>
			<input type="text" name="email" value="<?php echo $register['login']; ?>">
			</p>
			<p>Пароль<br/>
			<input type="password" name="password" value="<?php echo $register['password']; ?>">
			</p>
			<p>Телефон<br/>
			<input type="text" name="phone" value="<?php echo $register['phone']; ?>">
			</p>
			<button type="submit">Изменить</button>
		</form>
	</div>
</div>

<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

</body>
</html>