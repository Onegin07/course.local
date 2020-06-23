<?php
  // подключаем базу данных
  include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
  // присваиваем переменной-флажку $page значение events, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
  $page = "events";
  // подключаем header.php, где хранятся начальные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
  

  if(isset($_GET['id'])) {
    // создаем запрос для базы данных для редактирования мероприятия
    $sql = "SELECT * FROM eventcalendar WHERE ID='" . $_GET['id'] . "'";
    // получаем результат из базы данных
    $result = $connect->query($sql);
    // получаем количество строк результата запроса
    $quantity = mysqli_num_rows($result);
    // присваиваем переменной результат запроса для получения массива
    $event = mysqli_fetch_assoc($result);
    // проверяем сколько продуктов мы получили по запросу
    if($quantity > 1) {
      // если больше одного выводим сообщение об ошибке
      echo "<h2>Mulfanction</h2>";
    } else {

?>

<div class="form">
  <!-- хлебные крошки для окна форма редактирование мероприятия -->
  <ul>
    <li><a href="../index.php">Главная </a></li>
    <li><a href="../pages/events.php">/ Мероприятия </a></li>
    <li><a>/ Форма редактирования мероприятия</a></li>
    
  </ul>

    <form id="editForm" action="editEvent.php" method="POST">
      <!-- создаем неотображаемый тег для отправки id продукта -->
      <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
      <label for="title">Наименование мероприятия</label>
      <input type="text" id="title" class="lessons" name="Title" placeholder="Введите наименование мероприятия" value="<?=$event["Title"]?>" autofocus>

      <label for="video">Детали мероприятия</label>
      <input type="text" id="video" class="lessons" name="Detail" placeholder="Введите детали мероприятия" value="<?=$event["Detail"]?>">

       <label for="video">Дата проведения мероприятия</label>
      <input type="text" id="video" class="lessons" name="eventDate" placeholder="Введите дату проведения мероприятия" value="<?=$event["eventDate"]?>">

      <input type="submit" class="bttn" value="Submit">
    </form>
</div>


<?php
    }
  }
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>