<?php

// подключаем файл конфигурации БД
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем файл настроек сайта
include $_SERVER['DOCUMENT_ROOT'] . '/configs/setup.php';

// меняем статус на Оффлайн
$sql_online = "UPDATE login SET isOnline = '0' WHERE loginId =" . $_COOKIE["user_id"];
$result_online = mysqli_query($connect, $sql_online);
$online = 0;

setcookie("user_id", "", 0); // удаляяем куки

header("Location: /"); // переадресация на главную страницу

?>