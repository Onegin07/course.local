<!-- файл обеспечивает работу страницы, предназначенную для уроков -->
<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	// присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
	$page = "lessons";
	// подключаем header.php, где хранятся начальные строки кода, общие для всех
 	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
 	
 	
?>

<div class="main">
	<h1>Список уроков</h1>
	<table id="ajax">	
	  <tr>
	    <th>Номер урока</th>
	    <th>Наименование урока</th>
	    <th>Видео</th>
	    <th>Опции</th>
	  </tr>
	   <?php
            // создаем запрос для получения всех уроков 
            $sql = "SELECT * FROM lessons";
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим данные о продукте
            while($row = mysqli_fetch_assoc($result)) {
            	
        ?>
        	<tr>
        		<td><?php echo $row["lessonId"] ?></td>
				<td><?php echo $row["title"] ?></td>
				<td><a href="#"><?php echo $row["video"] ?></a></td>
				<td>
					<a class="button" href="../modules/editLessonForm.php?id=<?php echo $row['lessonId'] ?>">Редактировать</a>
					<!-- присваиваем тегу title со значением del, который используем	в стилях для кнопок для изменения цвета кнопки -->
					<a class="button" title="del" href="/admin/modules/deleteLesson.php?id=<?php echo $row['lessonId'] ?>/">Удалить</a>	
				</td>

        	</tr>
			  
	  <?php
			}
	  ?>
	  
	</table>
	<br><br>
	<!-- создаем кнопку -->
	<a class="button" href="../modules/addLessonForm.php">Добавить урок</a>
</div>

<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>