<?php
  // подключаем базу данных
  include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
  // присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
  $page = "lessons";
  // подключаем header.php, где хранятся начальные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
  
?>

<div class="form">
  <!-- хлебные крошки для окна Добавить урок -->
  <ul>
  <li><a href="../index.php">Главная </a></li>
  <li><a href="../pages/lessons.php">/ Уроки </a></li>
  <li><a>/ Форма добавления урока</a></li>
  
</ul>

  <form action="addLesson.php" method="POST">
    <label for="title">Наименование урока</label>
    <input type="text" id="title" class="lessons" name="title" placeholder="Введите наименование урока" autofocus>

    <label for="video">Видео</label>
    <input type="text" id="video" class="lessons" name="video" placeholder="Введите путь до видео">

    <input type="submit" class="bttn" value="Submit">
  </form>
</div>



<?php
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>