
<!-- Блок списка сообщений -->
<div id="message-list">

<?php				
		// если выбран юзер из списка или установлен текущий адресат
		if (isset($_GET["userid"]) || isset($current_to_user_id)) {
			
			$to_user_id = null; // переменная для хранения ID юзера, которому отправляется сообщение

			// если есть GET-запрос с userid
			if(isset($_GET["userid"])) {
				$to_user_id = $_GET["userid"];
			} else {
				$to_user_id = $current_to_user_id;
			}

			?>
			<!-- Выводим название диалога -->
			<div id="dialogue-name">
				<?php
					// запрос на вывод имени выбранного юзера
					$sql_dialogue = "SELECT FirstName, LastName FROM login WHERE loginId=" . $to_user_id;
					// выполняем запрос
					$result_dialogue = mysqli_query($connect, $sql_dialogue);
					// выбираем текущего адресата
					$user_dialogue = mysqli_fetch_assoc($result_dialogue);
				?>
				<h2><?php echo $user_dialogue["FirstName"] . ' ' . $user_dialogue["LastName"]; ?></h2>
				
				<!-- <img width="24" src="/images/users.png">&nbsp;<a href="#">Все ученики</a> -->
			</div>
			<ul>
			<?php

			// если выполнен вход
			if(isset($_COOKIE["user_id"])) {

				// если выбран общий чат, то выводим сообщения от всех юзеров
				if($to_user_id == 2) {
					// запрос получения сообщений общего чата
					$sql_general = "SELECT * FROM messagesprivate WHERE recieverID = 2";
					$result_general = mysqli_query($connect, $sql_general);
					$messages_number_general = mysqli_num_rows($result_general);
					
					$k = 0; // счетчик цикла проверки сообщений общего диалога
					while($k < $messages_number_general) {
						$single_message_general = mysqli_fetch_assoc($result_general); // создание массива с сообщениями
	?>
						<li>
	<?php
						// выбираем имена, фамилии и фото юзеров общего диалога
						$sql_general = "SELECT FirstName, LastName, photo FROM login WHERE loginId=" . $single_message_general["senderID"];
						$user_general = mysqli_query($connect, $sql_general); // выполняем запрос
						$user_general = mysqli_fetch_assoc($user_general); // создаем ассоц. массив

						// выводим список сообщений общего диалога
	 					echo "<div class=\"user\">
									<img src=\"". '/' . $user_general["photo"] . "\">
							  </div>";
	?>
							<h2><a href="index.php?userid=<?php echo $single_message_general["senderID"]; ?>"><?php echo $user_general["FirstName"] . ' ' . $user_general["LastName"]; ?></a></h2>
		 					<div class="msg"><?php echo $single_message_general["privateMessageText"]; ?></div>
		 					<div class="time"><?php echo $single_message_general["createdAt"]; ?></div>
		 				</li>
	<?php

						$k = $k + 1;
					}
				} else {
					// запрос получения всех сообщений, отправленных юзером и адресованных ему выбранным юзером 
					$sql = "SELECT * FROM messagesprivate WHERE (recieverID = " . $to_user_id .
					" AND senderID = " . $_COOKIE["user_id"] . ")" . 
					" OR (recieverID = " . $_COOKIE["user_id"] . " AND senderID = " . $to_user_id . ")";
					// выполняем запрос
					$result_msg = mysqli_query($connect, $sql);
					// получаем количество сообщений в БД
					$messages_number = mysqli_num_rows($result_msg);
					
					$i = 0; // счетчик цикла проверки сообщений
					while($i < $messages_number) {
						$single_message = mysqli_fetch_assoc($result_msg); // создание массива с сообщениями
	?>
						<li>
	<?php
						// выбираем имена, фамилии и фото юзеров
						$sql = "SELECT loginId, FirstName, LastName, photo FROM login WHERE loginId=" . $single_message["senderID"];
						$user = mysqli_query($connect, $sql); // выполняем запрос
						$user = mysqli_fetch_assoc($user); // создаем ассоц. массив
	 					
	 					// выводим список сообщений
	 					echo "<div class=\"user\">
									<img src=\"". '/' . $user["photo"] . "\">
							  </div>";
	?>
							<h2><?php echo $user["FirstName"]; ?></h2>
		 					<div class="msg"><?php echo $single_message["privateMessageText"]; ?></div>
		 					<div class="time"><?php echo $single_message["createdAt"]; ?></div>
	<?php
							// выводим кнопку Удалить только на сообщениях юзера в куки
							if($user["loginId"] == $_COOKIE["user_id"]) {
								echo "<div class=\"remove\" data-msglink=\"http://course.bobo.kiev.ua/chat/remove_message.php?msgid=" . $single_message["privateMessageId"] . "\" onclick=\"removeMessage(this)\">Удалить</div>";
							}
	?>	
	 					</li>
	<?php
						$i = $i + 1;	
					}
				}			
			}
		} else {
			echo "<h2 style=\"margin-left:10px;\">Выберите диалог<h2>";
		}
?>
	</ul>
</div>

<script type="text/javascript">
	
	// Функция удаления сообщения без перезагрузки страницы
	function removeMessage(element) {
		var link = element.dataset.msglink; // ссылка в блоке удаления юзера

		var ajax = new XMLHttpRequest(); // объект для отправки http-запроса
			ajax.open('GET', link, false); // открываем ссылку, передав метод запроса
			ajax.send(); // отправляем запрос

		var messageList = document.querySelector("#message-list"); // выбираем ul по ID
		//messageList.innerHTML = ajax.response; // изменяем содержимое списка #user-contacts 

		document.location.reload();
	}

</script>