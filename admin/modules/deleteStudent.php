<!-- файл обеспечивает удаление учеников из таблицы login
	 базы данных course -->
<?php
// загружаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
// проверяем существует ли GET-запрос
if(isset($_GET['id'])) {
	// создаем запрос для базы данных для удаления пользователя
	$sql = "DELETE FROM login WHERE loginId='" . $_GET['id'] . "'";
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		// если да, то переходим на страницу Products
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/studentsList.php');
	} else {
		// если нет выводим сообщение об ошибке
		echo "<h2>Mulfanction</h2>";
	}
}
?>