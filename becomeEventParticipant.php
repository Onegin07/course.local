 <!-- файл добавляет ученика как участника мероприятия в таблицу eventparticipants
	 базы данных course -->
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";

// блок обработки добавления ученика
// проверяем существуют ли POST-запросы созданные формой добавления урока
if(isset($_GET["id"])) {
	//если да, то создаем запрос для базы данных
	$sql = "INSERT INTO eventparticipants (eventID, participantID) VALUES ('" . $_GET['id'] . "', '" . $_COOKIE['user_id'] . "')";
	//посылаем запрос и делаем маленькую проверку
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		// если да, то переходим на страницу Products
		header("location: /events.php");
	} else {
		// если нет выводим сообщение
		echo"Malfunction";
	}
}
