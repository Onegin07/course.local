<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	// присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
 	$page = "tasks";
	// подключаем header.php, где хранятся начальные строки кода, общие для всех
 	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
 	
?>

<div class="main">
	<h1>Задания учеников</h1>
	<table>
	  <tr>
	    <th>Ссылка на папку Drive</th>
	    <th>От Ученика</th>
	    <th>Опции</th>
	  </tr>
	   <?php
            // создаем запрос для получения всех уроков 
            $sql = "SELECT * FROM tasks";
            // заносим в переменную результаты запроса
            $result = $connect->query($sql);
            // запускаем цикл, присваиваем переменной row строку из переменной $result 
            // и пока row не равен NULL выводим ссылки
            while($row = mysqli_fetch_assoc($result)) {

        ?>
			  <tr>
			    <td><a href="../modules/taskOnCheck.php?id=<?php echo $row["senderID"] ?>:1" target="_blank">
			    	<?php echo $row["title"] ?></td>
			    </a>
			    <td><?php echo $row["senderID"] ?></td>
			    
			    <td>
			    	<a class="button" href="../modules/taskOnCheck.php?id=<?php echo $row["senderID"] ?>:2">Зачет</a>
			    	<!-- присваиваем тегу title со значением del, который используем	в стилях для кнопок для изменения цвета кнопки -->
			    	<a class="button" title="del" href="../modules/taskOnCheck.php?id=<?php echo $row["senderID"] ?>:3">Отклонить</a>	
			    </td>
			  </tr>
	  <?php
	  					}
	  ?>
	  
	</table>
</div>

<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>