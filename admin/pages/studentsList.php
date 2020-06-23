<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	// присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
 	$page = "students";
	// подключаем header.php, где хранятся начальные строки кода, общие для всех
 	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
 	
?>

<div class="main">
	<h1>Список учеников</h1>
	<table>
	  <tr>
	  	<th>ID</th>
	    <th>Имя</th>
	    <th>Фамилия</th>
	    <th>Номер урока</th>
	    <th>Опции</th>
	  </tr>
	   <?php
            // создаем запрос для получения всех учеников 
            $sql = "SELECT * FROM login WHERE loginId > 2";
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим данные о продукте
            while($row = mysqli_fetch_assoc($result)) {
        ?>
			  <tr>
			  	<td><?php echo $row["loginId"] ?></td>
			    <td><?php echo $row["FirstName"] ?></td>
			    <td><?php echo $row["LastName"] ?></td>
			    <td><?php echo $row["currentLesson"] ?></td>
			    <td>
			    	<a class="button" href="/admin/modules/editStudentForm.php?id=<?php echo $row['loginId'] ?>">Редактировать</a>
			    	<!-- присваиваем тегу title со значением del, который используем	в стилях для кнопок для изменения цвета кнопки -->
			    	<a class="button" title="del" href="../modules/deleteStudent.php?id=<?php echo $row['loginId'] ?>">Удалить</a>	
			    </td>
			  </tr>
	  <?php
			}
	  ?>
	  
	</table>
	<!-- <br><br>
	создаем кнопку -->
	<!--<a class="button" href="#../modules/addLessonForm.php">Добавить ученика</a> -->
</div>

<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";