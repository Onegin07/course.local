<!-- файл создает меню для левого navBar -->
<?php
		
	if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] ==1) {
?>

<div class="sidebar">
	<a href="/">
		<div id="logo">
			<img src="/images/old-school.jpg">
		</div>
	</a>
	<?php
		// проверяем значение переменной $page для определения активной ссылки
		switch ($page) {
			// если кликнули на Главную страницу
			case 'index':
	?>
			  <a id="main" href="/admin/index.php" style="color: #f1f1f1;"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php">Уроки</a>
			  <a id="tasks"  href="/admin/pages/tasks.php">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php">Список учеников</a>
			  <a id="events" href="/admin/pages/events.php">Мероприятия</a>
	<?php
			break;
			// если кликнули на страницу Уроки
			case 'lessons':

	?>
			  <a id="main" href="/admin/index.php"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php" style="color: #f1f1f1;">Уроки</a>
			  <a id="tasks" href="/admin/pages/tasks.php">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php">Список учеников</a>
			  <a id="events" href="#contact">Мероприятия</a>
	<?php
			break;
			case 'tasks':
	?>
			  <a id="main" href="/admin/index.php"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php">Уроки</a>
			  <a id="tasks"  href="/admin/pages/lessons.php" style="color: #f1f1f1;">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php">Список учеников</a>
			  <a id="events" href="/admin/pages/events.php">Мероприятия</a>
	<?php	
			break;
			case 'students':
	?>
			  <a id="main" href="/admin/index.php"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php">Уроки</a>
			  <a id="tasks"  href="/admin/pages/lessons.php">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php" style="color: #f1f1f1;">Список учеников</a>
			  <a id="events" href="/admin/pages/events.php">Мероприятия</a>
	<?php	
			break;
			case 'events':
	?>
			  <a id="main" href="/admin/index.php"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php">Уроки</a>
			  <a id="tasks"  href="/admin/pages/lessons.php">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php">Список учеников</a>
			  <a id="events" href="/admin/pages/events.php" style="color: #f1f1f1;">Мероприятия</a>
	<?php	
			break;
			case 'chat':
	?>
				
			  <a id="main" href="/admin/index.php"></i>Главная</a>
			  <a id="lessons" href="/admin/pages/lessons.php">Уроки</a>
			  <a id="tasks"  href="/admin/pages/lessons.php">Задания учеников</a>
			  <a id="chat" href="/admin/pages/studentsList.php">Список учеников</a>
			  <a id="events" href="/admin/pages/events.php">Мероприятия</a>
	<?php	
			break;
		}
	?>
</div>
<?php
	}
?>		
