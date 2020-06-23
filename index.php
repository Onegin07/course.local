<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_name; ?></title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	</head>
<body>

<!-- Шапка сайта -->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
?>

<!-- Основной блок -->
	<div id="content" class="main light">
		<!-- <h2>Главная страница сайта</h2> -->
		<div>
			<center><img src="/images/Untitled-2.png"></center>
		</div>
		<div class="reasons">
			<center><img src="/images/fun.png">
			<h3>Весело</h3></center>
		</div>
		<div class="reasons">
			<center><img src="/images/puzzle.png">
			<h3>Эффективно</h3></center>
		</div>
		<div class="reasons">
			<center><img src="/images/clock.png">
			<h3>Быстро</h3></center>
		</div>
		<div class="reasons">
			<center><img src="/images/like.png">
			<h3>Удобно</h3></center>
		</div>
	</div>

<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

</body>

</html>