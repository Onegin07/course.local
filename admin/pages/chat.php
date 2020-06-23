<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
	// присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
 	$page = "chat";
	// подключаем header.php, где хранятся начальные строки кода, общие для всех
 	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
 	
?>

<div class="main">
	<h1>Чат с учениками</h1>
	<?php
				
		header("location: http://" . $_SERVER['HTTP_HOST'] . '/chat/index.php');
	?>
</div>

<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>