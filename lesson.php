<!-- файл урока, где выводится выбранный учеником урок, соотвестующее видео, а также ссылки на материалы, д.з. и полезный -->
<?php
	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';
?>
<!-- подключаем стили -->
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
    // создаем переменную, что соответствует авторизированому пользователю
    $user["id"] = $_COOKIE["user_id"];
?>
	<!-- Основной блок -->
	<div id="content" class="main">
		<!-- хлебные крошки для окна урок -->
		<ul>
		    <li><a href="/index.php">Главная </a>
            <a href="/lessons-list.php">/ Уроки </a>
		    <a>/ <?php echo $lesson['title']?></a></li>  
		  </ul>
		<?php
		// делаем вывод данных урока согласно гет запроса
		$sql = "SELECT * FROM lessons WHERE lessonId=" . $_GET["lessonId"];
        $lesson = mysqli_fetch_assoc( $connect->query($sql) );
        ?>
		<div class="left-col">
			  <!-- выводим необходимое название урока -->
              <h2><?php echo $lesson['title']?></h2>
              <!-- выводим необходимое видео переменной -->
			  <iframe width="600" height="360" src="https://www.youtube.com/embed/<?php echo $lesson['video']?>" frameborder="0" allowfullscreen></iframe>
			<!-- Форма отправки домашнего задания -->
			<br>
			<p><b>Отправить домашнее задание</b></p>
			<form method="POST">
				<!-- <input type="hidden" value=""> -->
				<input type="hidden" name="student_id" value="<?php echo $user["id"] ?>">
				<textarea type="text" name="HW-link" rows="1"></textarea>
				<button type="submit" name="send_HW" value ="1">Отправить на проверку</button>
			</form>
			<?php
            // Делаем проверку на отправку д.з.
             if(isset($_POST["send_HW"])){
			  // делаем запрос на добавление д.з. 
			  $sql = "INSERT INTO tasks (title, senderID) VALUES ('" . $_POST["HW-link"] . "', '" . $_POST["student_id"] . "')";
			  // если соединение по добавлению д.з. произошло
			  if($connect->query($sql)) {
			    // то после добавления выводим уведомление
			    echo "<h4>домашнее задание отправлено<h4>";
			  }
			}
            ?>
        <!-- Вывод ссылок (материалы уроков, домашнее задание, полезные ссылки)-->
		</div>
		<div class="right-col">
			<p><b>Материалы урока</b></p>
			<ul>
				<li><a href="https://drive.google.com/open?id=1hWvTg8-XjhOtBKnPgKarPKa2k-PtA2Ap" target="_blank">Ссылка №1</a></li>
				<li><a href="https://drive.google.com/open?id=1I9nYziKNXsoixXXmyVuXki_W7tWmXhvS" target="_blank">Ссылка №2</a></li>
				<li><a href="https://drive.google.com/open?id=1WH76I0ZDc76ID8NAN_S8Gf0_JJA8ZmqU" target="_blank">Ссылка №3</a></li>
			</ul>
			<p><b>Домашнее задание</b></p>
			<ul>
				<li><a href="https://drive.google.com/open?id=18-Tf6LE4fgi4sQLx9xOIohSjKf7Mff57" target="_blank">Ссылка</a></li>
			</ul>
			<p><b>Полезные ссылки</b></p>
			<ul>
				<li><a href="https://learn.javascript.ru/while-for" target="_blank">Ссылка №1</a></li>
				<li><a href="https://metanit.com/web/javascript/1.1.php" target="_blank">Ссылка №2</a></li>
				<li><a href="https://professorweb.ru/my/javascript/js_theory/level1/1_10.php" target="_blank">Ссылка №3</a></li>
			</ul>
		</div>
	</div>
<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>
</body>
</html>