<?php
  // подключаем базу данных
  include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
  // присваиваем переменной-флажку $page значение lessons, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
  $page = "students";
  // подключаем header.php, где хранятся начальные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/header.php";
  

  if(isset($_GET['id'])) {
    // создаем запрос для базы данных для редактирования урока
    $sql = "SELECT * FROM login WHERE loginId='" . $_GET['id'] . "'";
    // получаем результат из базы данных
    $result = $connect->query($sql);
    // получаем количество строк результата запроса
    $quantity = mysqli_num_rows($result);
    // присваиваем переменной результат запроса для получения массива
    $student = mysqli_fetch_assoc($result);
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
    <li><a href="../pages/studentsList.php">/ Список учеников </a></li>
    <li><a>/ Форма редактирования данных ученика</a></li>
    
  </ul>

    <form action="editStudent.php" method="POST">
      <!-- создаем неотображаемый тег для отправки id продукта -->
      <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
      <label for="fname">Имя</label>
      <input type="text" id="fname" class="students" name="fname" value="<?=$student["FirstName"]?>" autofocus>

      <label for="lname">Фамилия</label>
      <input type="text" id="lname" class="students" name="lname" value="<?=$student["LastName"]?>">

      <label for="email">Email</label>
      <input type="text" id="email" class="students" name="email" value="<?=$student["login"]?>">

      <label for="password">Пароль</label>
      <input type="text" id="password" class="students" name="password" value="<?=$student["password"]?>">

      <label for="photo">Путь к фото</label>
      <input type="text" id="photo" class="students" name="photo" value="<?=$student["photo"]?>">

      <label for="phone">Телефон</label>
      <input type="text" id="phone" class="students" name="phone" value="<?=$student["phone"]?>">

      <label for="curLesson">Текущий урок</label>
      <input type="text" id="curLesson" class="students" name="curLesson" value="<?=$student["currentLesson"]?>">

      <input type="submit" class="bttn" value="Submit">
    </form>
</div>



<?php
    }
  }
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>