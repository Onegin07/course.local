<ul>
	
	<?php

		// подключаем файл конфигурации БД
		include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
		
		// выводим список юзеров в левой колонке
		$i = 0;

		// если поиск отправлен в POST-запросе и не пуст
		if(isset($_POST["search-text"]) && $_POST["search-text"] !="") {
			// запрос для поиска соответствий по юзерам
			$sql_search = "SELECT * FROM login WHERE (FirstName LIKE '%" . $_POST["search-text"] . "%') OR (LastName LIKE '%" . $_POST["search-text"] . "%')";
			$result_search = mysqli_query($connect, $sql_search); // выполняем запрос
			$users_search_number = mysqli_num_rows($result_search); // количество найденных соответствий
		
			// если количество найденных соответствий не равно 0, то выводим список найденных
			if($users_search_number != 0) {
				while($i < $users_search_number) {	
					$users_mass[$i] = mysqli_fetch_assoc($result_search); 		
					// вывод списка найденных юзеров, кроме преподавателя, общего чата и юзера в куки
					if($users_mass[$i]["loginId"] != 1 && $users_mass[$i]["loginId"] != 2 && $users_mass[$i]["loginId"] != $_COOKIE["user_id"]) {
						echo "<li>";
							echo "<a href='/chat/index.php?userid=" . $users_mass[$i]["loginId"] . "'>";
								echo "<div class=\"user\">
									 	<img src='/". $users_mass[$i]["photo"] . "'>
									  </div>";
								echo "<h2>" . $users_mass[$i]["FirstName"] . '<br>' . $users_mass[$i]["LastName"] . "</h2>";
							echo "</a>";
						echo "</li>";
					} 
					$i = $i + 1; 
				}
			} else {
				echo "<li><b>Не найдено</b></li>";
			}
		} else {
			// иначе просто выводим список юзеров
			$sql = "SELECT * FROM login WHERE loginId!=" . $_COOKIE["user_id"]; // запрос к БД
			$result_users = mysqli_query($connect, $sql); // выполнение запроса к БД
			$users_number = mysqli_num_rows($result_users); // количество записей в таблице users

			// выводим всех юзеров
			while($i < $users_number) {	
				$users_mass[$i] = mysqli_fetch_assoc($result_users); // создание массива с пользователями
					
					// выбираем непрочитанные сообщения, адресованные куки-юзеру выбранным юзером
					$sql_read = "SELECT * FROM messagesprivate WHERE isRead = 0 AND recieverID =" . $_COOKIE["user_id"] . " AND senderID =" . $users_mass[$i]["loginId"];
					$result_read = mysqli_query($connect, $sql_read);
					$messages_number_read = mysqli_num_rows($result_read); // количество непрочитанных сообщений
					$messages_mass[$i] = mysqli_fetch_assoc($result_read); // массив непрочитанных собщений
					
					// если выбран диалог
					if($_GET["userid"] == $users_mass[$i]["loginId"]) {

						// устанавливаем статус сообщения как прочитнанное (isRead = '1')
						$sql_read = "UPDATE messagesprivate SET isRead = '1' WHERE privateMessageId =" . $messages_mass[$i]["privateMessageId"];
						$result_read = mysqli_query($connect, $sql_read);
						
						// вывод с подсветкой активного диалога
						echo "<li class=\"active\">";
							echo "<a href='/chat/index.php?userid=" . $users_mass[$i]["loginId"] . "'>";
								echo "<div class=\"user\">
									 	<img src='". $users_mass[$i]["photo"] . "'>
									  </div>";
								echo "<h2>" . $users_mass[$i]["FirstName"] . '<br>' . $users_mass[$i]["LastName"] ."</h2>";
								
								// проверка статуса Онлайн-Оффлайн юзера
								if($users_mass[$i]["isOnline"] == 1) {
									echo "<p>Online</p>";
								}

								if($messages_number_read != 0) {
									echo "<div class=\"notify\"><span>" . $messages_number_read . "</span></div>";
								} else {
									echo "";
								}
							echo "</a>";
						echo "</li>";
					} else {
						
						// вывод списка юзеров
						echo "<li class=\"chat-" . $users_mass[$i]["loginId"] . "\">";
							echo "<a href='/chat/index.php?userid=" . $users_mass[$i]["loginId"] . "'>";
								echo "<div class=\"user\">
									 	<img src='". $users_mass[$i]["photo"] . "'>
									  </div>";
								echo "<h2>" . $users_mass[$i]["FirstName"] . '<br>' . $users_mass[$i]["LastName"] ."</h2>";
								
								// проверка статуса Онлайн-Оффлайн юзера
								if($users_mass[$i]["isOnline"] == 1) {
									echo "<p>Online</p>";
								}
								
								// если есть непрочитанные сообщения, выводим уведомление
								if($messages_number_read != 0) {
									echo "<div class=\"notify\"><span>" . $messages_number_read . "</span></div>";
								} else {
									echo "";
								}
							echo "</a>";
						echo "</li>";
					}
					
				$i = $i + 1; 
			}
		}
	?>
</ul>