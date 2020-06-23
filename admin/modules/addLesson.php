<!-- файл обеспечивает добавление уроков в таблицу lessons
	 базы данных course -->
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
// блок обработки добавления продукта
// проверяем существуют ли POST-запросы созданные формой добавления урока
if(isset($_POST["title"]) && isset($_POST["video"])) {
	//если да, то создаем запрос для базы данных
	$sql = "INSERT INTO lessons (title, video) VALUES ('" . $_POST["title"] . "', '" . $_POST["video"] . "')";
	
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