<!-- файл обеспечивает удаление уроков из таблицы lessons
	 базы данных course -->
<?php
// загружаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
// проверяем существует ли GET-запрос
if(isset($_GET['id'])) {
	// создаем запрос для базы данных для удаления урока
	$sql = "DELETE FROM lessons WHERE lessonId='" . $_GET['id'] . "'";
	// проверяем удачно ли осуществился запрос
	if($connect->query($sql)) {
		// если да, то переходим на страницу lessons
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/admin/pages/lessons.php');
	} else {
		// если нет выводим сообщение об ошибке
		echo "<h2>Mulfanction</h2>";
	}
}
?>