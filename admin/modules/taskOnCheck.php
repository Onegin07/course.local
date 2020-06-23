<!-- этот файл обрабатывает клик по ссылке на домашку -->
<!-- посылает сообщение ученику и переходит по ссылке -->
<?php
// загружаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";

// проверяем существует ли GET-запрос, в котором получаем id
// ученика пославшего домашку

if(isset($_GET['id'])) {
	// запрос $_GET["id"] состоит из двух элементов [id: флажка ссылки] и с помощью 
	// функции explode() разбивает строку на подстроки [0]-id ученика, пославшего,
	// запрос [1]-флажок ссылки, которая послала _GET запрос и присваиваем переменной
	$status = explode(':', $_GET["id"]);
	
	switch ($status[1]) {
		case '1':
			$message = "Задание начало проверяться";
			break;
		case '2':
			$message = "Задание принято";
			break;
		case '3':
			$message = "Задание отклонено";
			break;
	}
	$sqlUser = "SELECT * FROM login WHERE loginId = '" . $_GET["id"] . "'";
	$result = $connect->query($sqlUser);
	$user = mysqli_fetch_assoc($result); 
	$curLesson = $user["currentLesson"] + 1;
	
	// создаем запрос для базы данных для добавления сообщения
	$sql = "INSERT INTO messagesprivate (privateMessageText, senderID, recieverID) VALUES ('" . $message . "', 1, '" . $status[0] . "')";
	
	// создаем запрос для базы данных и увеличиваем значение текущего урока ученика на 1 
	$sqlCurrentLesson = "UPDATE `login` SET `currentLesson` = '" . $curLesson . "' WHERE `loginId` = '" . $status[0] . "'";
	// проверяем если задание принято, то увеличиваем значение текущего урока ученика
	if($status[1] == 2) {
		$connect->query($sqlCurrentLesson);
	}
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		// делаем еще одну проверку, по какому тегу <a> на странице tasks.php произошел переход
		if($status[1] == 1) {
			// если по ссылке на Drive, то переходим по ссылке на страницу Drive
			header("location: https://drive.google.com/drive/folders/1mrxIZMZzVFW9VqVOvFgkijaZBIXxofn8");
		} else {
			// в противном случае возвращаемся на страницу tasks.php
			header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/tasks.php');
		}
	} else {
		// если нет выводим сообщение об ошибке
		echo "<h2>Mulfanction</h2>";
	}
}
?>
