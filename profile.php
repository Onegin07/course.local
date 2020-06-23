<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	// маркер для главного меню
    $page = "profile";


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
	<center><h2>Профиль</h2></center>
  <ol class="bullet">
	<form method="POST">
		<?php
		if(isset($_COOKIE["user_id"])) {
			$sql = "SELECT * FROM login WHERE loginId=" . $_COOKIE["user_id"];
			$result = mysqli_query($connect, $sql);
			$polzovatel = mysqli_fetch_assoc($result);
		?>
			<li><b>Имя:</b> <?php echo $user["FirstName"]; ?>

	</li>
	<li><b>Фамилия:</b> <?php echo $user["LastName"]; ?>

	</li>
	<li><b>Email:</b> <?php echo $user["login"]; ?>

	</li>
	<li><b>Телефон:</b> <?php echo $user["phone"]; ?>

	</li>
	<li><a href="/edit_profile.php">Изменить</a>
	</li>
		<?php 
		
	} 
?>
</form>
</ol>
</div>

<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

</body>
</html>