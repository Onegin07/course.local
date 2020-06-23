<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	// маркер для главного меню
    $page = "chat";

	// проверка вход в систему
	if($cookie_user_id == null) {
	// если вход не выполнен, то переадресация на страницу входа
		header("Location: /login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_name; ?></title>
	<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>

<!-- Шапка сайта -->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
?>

<!-- Основной блок -->
	<div id="content" class="main">
		<div id="users">
			<?php
				// выбираем из БД юзера с ID, который хранится в куки
				$sql = "SELECT * FROM login WHERE loginId=" . $_COOKIE["user_id"];
				$result = mysqli_query($connect, $sql);
				$user = mysqli_fetch_assoc($result);
			?>
			<div id="list-saved">
				<ul>
					<li class="<?php if($_GET["userid"] == $_COOKIE["user_id"]) { echo "active"; } ?>">
						<a href="index.php?userid=<?php echo $user["loginId"]; ?>">
							<div class="user">
								<img src="/<?php echo $user["photo"]; ?>">
							</div>
							<h2><?php echo $user["FirstName"]; ?></h2>
							<p><i>Мои заметки</i></p>
						</a>
					</li>
				</ul>
			</div>

			<!-- Блок поиска -->
			<div id="search">
				<form id="form-search" action="http://course.bobo.kiev.ua/chat/modules/list-users.php" method="POST">
					<img src="/images/search.png"><input type="text" name="search-text">
					<button type="submit" name="search-btn"><img src="/images/search.png"></button>
				</form>
			</div>
			
			<!-- Блок списка контактов -->
			<div id="list">
				<?php
					// Вывод списка сообщений
					include $_SERVER['DOCUMENT_ROOT'] . '/chat/modules/list-users.php';
				?>
			</div>
		</div>

		<!-- Блок списка сообщений -->
		<div id="messages">
			
			<?php
				// Вывод списка сообщений
				include $_SERVER['DOCUMENT_ROOT'] . '/chat/modules/list-messages.php';
			?>
			
			<!-- Блок формы отправки сообщений -->
			<div id="message-form">
				<?php
					// выбираем из БД юзера с ID, который хранится в куки
					$sql = "SELECT * FROM login WHERE loginId=" . $_COOKIE["user_id"];
					$result = mysqli_query($connect, $sql);
					$user = mysqli_fetch_assoc($result);
				?>
				<div class="user">
					<img src="<?php echo '/' . $user["photo"]; ?>">
				</div>
				
				<!-- Форма отправки сообщения -->
				<form id="form" action="http://course.bobo.kiev.ua/chat/send-message.php" method="POST">
					<input type="hidden" name="from_user_id" value="<?php echo $cookie_user_id; ?>"> 
					<input type="hidden" name="to_user_id" value="<?php echo $_GET["userid"]; ?>"> 
					<textarea name="message"></textarea>
					<button type="submit" name="send_msg"><img src="images/send.png"></button>
				</form>	
							
			</div>

		</div>

	</div>

<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

</body>

</html>