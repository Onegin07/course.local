 <!-- файл расписания, где отображаются мероприятия которые создал преподаватель, ученик может отметить интересуешее его миероприятие и это уведомление увидит преподователь -->
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
?>
	<!-- Основной блок -->
	<div id="content" class="main">
		<!-- Выводим таблицу расписания мероприятий -->
		<center><h2>Расписание мироприятий</h2></center>
			<table class="table_blur">
	  <tr>
	    <th>Название мироприятия</th>
	    <th>Дата и время проведения</th>
	  </tr>
	  <?php
            // создаем запрос для получения всех уроков 
            $sql = "SELECT * FROM eventcalendar";
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим данные о мероприятиях
            while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
			    <td>
			    	<!-- делаем ссылку, что бы ученик мог отметит интересующее его мероприятие -->
			    	<a href="becomeEventParticipant.php?id=<?php echo $row['ID'] ?>"><?php echo $row["Title"] ?></a>
			    </td>
			    <td width="50"><?php echo $row["eventDate"] ?></td>
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