<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	// присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
 	$page = "events";
	// подключаем header.php, где хранятся начальные строки кода, общие для всех
 	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
 	
?>

<div class="main">
	<h1>Мероприятия</h1>
	<table>
	  <tr>
	    <th>Мероприятие</th>
	    <th>Время проведения</th>
	    <th>Опции</th>
	  </tr>
	   <?php
	   		// создаем запрос на удаление всех event меньше текущей даты
	   		$sqlDel = "DELETE FROM eventcalendar WHERE str_to_date(eventDate, '%m/%d/%Y') < CURRENT_DATE()";
	   		// удаляем ивенты
	   		$connect->query($sqlDel);
            // создаем запрос для получения всех event-ов 
            $sql = "SELECT * FROM eventcalendar";
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим данные о продукте
            while($row = mysqli_fetch_assoc($result)) {

        ?>
			  <tr>
			    <td style="font-size: 14px"><?php echo $row["Title"] ?></td>
			    <td style="font-size: 12px"><?php echo $row["eventDate"] ?></td>
			    <td>
			    	<a class="button" href="../modules/editEventForm.php?id=<?php echo $row['ID'] ?>" style="font-size: 10px;  padding: 10px 10px;">Редактировать</a>
			    	<!-- присваиваем тегу title со значением del, который используем	в стилях для кнопок для изменения цвета кнопки -->
			    	<a class="button" title="del" href="../modules/deleteEvent.php?id=<?php echo $row['ID'] ?>" style="font-size: 10px; padding: 10px 10px;">Удалить</a>	
			    </td>
			  </tr>
	  <?php
			}
	  ?>
	  
	</table>
	<br><br>
	<!-- создаем кнопку -->
	<a class="button" href="/admin/calender.php">Добавить мероприятие</a>
	<!-- <?php
		// include $_SERVER['DOCUMENT_ROOT']."/admin/calender.php";
	?> -->
</div>

<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>