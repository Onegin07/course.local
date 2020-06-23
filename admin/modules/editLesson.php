<!-- файл обеспечивает редактирование уроков в таблице lessons
	 базы данных course -->
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";

// проверяем существуют ли POST-запросы созданные формой редактирования уроков
if(isset($_POST["title"]) && isset($_POST["video"])) {
	//если да, то создаем запрос для базы данных
	$sql = "UPDATE `lessons` SET 
							`title`= '" . $_POST["title"] . "', 
							`video`='" . $_POST["video"] . "'
			WHERE `lessonId` = '" .$_POST["id"] . "';";

	
	//посылаем запрос и делаем маленькую проверку
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		// если да, то переходим на страницу Products
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/lessons.php');
	}else {
		// если нет выводим сообщение
		echo"Malfunction";
	}
}
?>