<!-- файл списка уроков, где выводится колличество уроков согласно пройденого учеником -->
<?php
	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';
	// маркер для главного меню
    $page = "lessons";
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
?>
	<!-- Основной блок -->
	<div id="content" class="main">
        <!-- хлебные крошки для окна урок -->
		<ul style="list-style: none;">
		    <li><a href="/index.php">Главная </a>/ Уроки</li>    
		</ul>
	<!-- <center><h2>Страница уроков</h2></center> -->
	<table class="table_dark">
	  <tr>
	    <th width="10">#</th>
	    <th>Название урока</th>
	  </tr>
	  <?php
	        // создаем переменную для авторизированого пользователя
            $user["id"] = $_COOKIE["user_id"];
            // выводим все данные авторизированого пользователя из таблицы login
            $sql = "SELECT * FROM login WHERE loginId =" . $user['id'];
            $result = $connect->query($sql);
            $user = mysqli_fetch_assoc($result);
            // создаем запрос для получения всех уроков 
            $sql = "SELECT * FROM lessons WHERE lessonId<=" . $user['currentLesson'];
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим данные об уроках
            while($row = mysqli_fetch_assoc($result)) { 
        ?>
        <tr>
			    <td><?php echo $row["lessonId"] ?></td>
                <!-- переменной выводим название урока со ссылкой -->
			    <td><a href="/lesson.php?lessonId=<?php echo $row["lessonId"]; ?>">
			    	<?php echo $row["title"] ?></td>
			    </a>
        </tr>
        <?php
			}
	    ?>
	</table>
    </div>
<!-- Footer-->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>
</body>
</html>