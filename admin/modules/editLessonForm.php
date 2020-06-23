<?php
  // подключаем базу данных
  include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
  // присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
  $page = "lessons";
  // подключаем header.php, где хранятся начальные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
  

  if(isset($_GET['id'])) {
    // создаем запрос для базы данных для редактирования урока
    $sql = "SELECT * FROM lessons WHERE lessonId='" . $_GET['id'] . "'";
    // получаем результат из базы данных
    $result = $connect->query($sql);
    // получаем количество строк результата запроса
    $quantity = mysqli_num_rows($result);
    // присваиваем переменной результат запроса для получения массива
    $lesson = mysqli_fetch_assoc($result);
    // проверяем сколько продуктов мы получили по запросу
    if($quantity > 1) {
      // если больше одного выводим сообщение об ошибке
      echo "<h2>Mulfanction</h2>";
    } else {

?>

<div class="form">
  <!-- хлебные крошки для окна Добавить урок -->
  <ul>
    <li><a href="../index.php">Главная </a></li>
    <li><a href="../pages/lessons.php">/ Уроки </a></li>
    <li><a>/ Форма редактирования урока</a></li>
    
  </ul>

    <form id="editForm" action="editLesson.php" method="POST">
      <!-- создаем неотображаемый тег для отправки id продукта -->
      <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
      <label for="title">Наименование урока</label>
      <input type="text" id="title" class="lessons" name="title" placeholder="Введите наименование урока" value="<?=$lesson["title"]?>" autofocus>

      <label for="video">Видео</label>
      <input type="text" id="video" class="lessons" name="video" placeholder="Введите путь до видео" value="<?=$lesson["video"]?>">

      <input type="submit" class="bttn" value="Submit">
    </form>
</div>



<?php
    }
  }
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>