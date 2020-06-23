<!-- Шапка чата -->
<div id="header">
	<div id="logo">
		<a href="/">
			<img src="/images/logo3.png"><span><?php echo $site_name; ?></span>
		</a>
	</div>
	<div id="menu">
		<?php
			// если вход выполнен
			if(isset($_COOKIE["user_id"])) {
				$sql = "SELECT * FROM login WHERE loginId=" . $_COOKIE["user_id"]; // выбираем из БД вошедшего юзера
				$result = mysqli_query($connect, $sql); // выполняем запрос
				$user = mysqli_fetch_assoc($result); // создаем ассоциацию с вошедшим юзером
		?>
				<!-- <a href="#" id="btn_switch"><img src="/images/light-off.png"></a> -->
				<a href="/events.php" class="<?php if($page == "events") {echo 'menu-active';} ?>">
					<img src="/images/events.png">&nbsp;Расписание</a>
				<a href="/lessons-list.php" class="<?php if($page == "lessons") {echo 'menu-active';} ?>">
					<img src="/images/lessons2.png" >&nbsp;Уроки</a>
				<a href="/chat/index.php" class="<?php if($page == "chat") {echo 'menu-active';} ?>">
					<img src="/images/message.png">&nbsp;Чат</a>
				<a href="/profile.php" class="<?php if($page == "profile") {echo 'menu-active';} ?>"><img src="/images/profile2.png">&nbsp;<?php echo $user["FirstName"]; ?></a>
				<a href="/logout.php"><img src="/images/logout.png">&nbsp;Выход</a>
		<?php
			} else {
		?>
				<a href="/login.php"><img src="/images/login.png">&nbsp;Вход</a>
		<?php		
			}
		?>
	</div>
</div>