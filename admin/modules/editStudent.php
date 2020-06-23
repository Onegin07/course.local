<!-- файл обеспечивает редактирование ученика в таблице login
	 базы данных course -->
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
// проверяем существуют ли POST-запросы созданные формой редактирования уроков
if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["photo"]) && isset($_POST["phone"]) && isset($_POST["curLesson"])) {
	//если да, то создаем запрос для базы данных
	$sql = "UPDATE `login` SET 
							`FirstName`= '" . $_POST["fname"] . "', 
							`LastName`='" . $_POST["lname"] . "',
							`login`= '" . $_POST["email"] . "', 
							`password`= '" . $_POST["password"] . "', 
							`photo`= '" . $_POST["photo"] . "',
							`phone`= '" . $_POST["phone"] . "',  
							`currentLesson`= '" . $_POST["curLesson"] . "'
			WHERE `loginId` = '" .$_POST["id"] . "';";

	
	//посылаем запрос и делаем маленькую проверку
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {

		// если да, то переходим на страницу Products
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/studentsList.php');
	}else {
		// если нет выводим сообщение
		echo"Malfunction";
	}
}
?>