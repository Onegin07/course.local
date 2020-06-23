<?php

// подключаем файл конфигурации БД
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем файл настроек сайта
include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

/* Отправка сообщения выбранному юзеру */

// если отправлено сообщение
if (isset($_POST["send_msg"])) {
	// если выбран юзер в списке
	if($_POST["to_user_id"] != 0) {
		// формируем запрос добавления в БД нового сообщения
		$sql = "INSERT INTO messagesprivate (`privateMessageText`, `senderID`, `recieverID`) VALUES ('" . $_POST["message"] . "', '" . $_POST["from_user_id"] . "', '" . $_POST["to_user_id"] . "');";
		// если запрос не выполнен, возвращаем код ошибки
		if(!mysqli_query($connect, $sql)) {
			echo "<h2>Ошибка отправки сообщения: " . mysqli_error($connect) . " </h2>";
		} 
	} else {
		// если юзер для отправки не выбран
		echo "<h2>Выберите диалог</h2>"; // выводим предупреждение
		die(); // останавливаем выполнение программы
	}
}

$current_to_user_id = $_POST["to_user_id"]; // ID текущего юзера, кому отправляется сообщение
$current_from_user_id = $_POST["from_user_id"]; // ID текущего юзера, который отправляет сообщение

include $_SERVER['DOCUMENT_ROOT'] . '/chat/modules/list-messages.php';

?>