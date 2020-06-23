<?php

	// подключаем файл конфигурации БД
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подключаем файл настроек сайта
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

	if(isset($_GET["msgid"])) {
		$sql = "DELETE FROM messagesprivate WHERE privateMessageId=" . $_GET["msgid"];
		if (mysqli_query($connect, $sql)) {
			include $_SERVER['DOCUMENT_ROOT'] . '/chat/modules/list-messages.php'; // выводим список сообщений
		} else {
			echo "<h2>Ошибка удаления сообщения</h2";
		}
	}

?>