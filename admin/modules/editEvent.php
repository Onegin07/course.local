<!-- файл обеспечивает редактирование мероприятий в таблице events
	 базы данных course -->
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	
// проверяем существуют ли POST-запросы созданные формой редактирования мероприятий
if(isset($_POST["Title"]) && isset($_POST["Detail"]) && isset($_POST["eventDate"])) {
	//если да, то создаем запрос для базы данных
	$sql = "UPDATE `eventcalendar` SET 
							`Title`= '" . $_POST["Title"] . "', 
							`Detail`='" . $_POST["Detail"] . "',
							`eventDate`='" . $_POST["eventDate"] . "'
			WHERE `ID` = '" .$_POST["id"] . "';";

	
	//посылаем запрос и делаем маленькую проверку
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		
		// если да, то переходим на страницу events
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/events.php');
	}else {
		// если нет выводим сообщение
		echo"Malfunction";
	}
}
?>