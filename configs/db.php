<?php

// параметры подключения к БД
$server = "bobo.mysql.tools";
$username = "bobo_course";
$password = "y#4nES7u_9";
$dbname = "bobo_course";

$connect = mysqli_connect($server, $username, $password, $dbname); // подключение к БД

mysqli_set_charset($connect, 'utf8'); // устанавливаем кодировку

?>