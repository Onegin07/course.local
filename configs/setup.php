<?php

// Файл общих настроек сайта

	$site_name = "UCoder.js"; // название сайта

	$cookie_user_id = null; // id юзера юзера в куки

	// если существует куки, то берем id залогиненного юзера
	if(isset($_COOKIE["user_id"])) {
		$cookie_user_id = $_COOKIE["user_id"];
	}

?>