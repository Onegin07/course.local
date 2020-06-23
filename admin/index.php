<?php
  // подключаем базу данных
  //include "../../configs/db.php";
  // присваиваем переменной-флажку $page значение index, которое будем использовать в файле sideNavMenu.php для определения активного тега <a>
   $page = "index";
  // подключаем header.php, где хранятся начальные строки кода, общие для всех
  include "parts/header.php";
  if(!isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] <> 1) {
?>
    <div class="main">
      <h1>Пожалуйста авторизируйтесь!</h1>
      <a href="/">
        <div id="logoLogin">
          <img src="/images/old-school.jpg">
        </div>
      </a>
  </div>
<?php
    } else {
?>


<div class="main">
  <h2>Мероприятия на ближайшие 10 дней</h2>
  <?php

    // создаем запрос для получения всех event-ов 
    $sql = "SELECT * FROM eventcalendar WHERE str_to_date(eventDate, '%m/%d/%Y') >= CURRENT_DATE() AND str_to_date(eventDate, '%m/%d/%Y') <= DATE_ADD(NOW(), INTERVAL 10 DAY)";
    // заносим в переменную результаты запроса
    $result = $connect->query($sql);
    // запускаем цикл, присваиваем переменной row строку из переменной $result 
    // и пока row не равен NULL выводим данные о продукте
    while($row = mysqli_fetch_assoc($result)) {
      
       $sqlParticipant = "SELECT * FROM eventparticipants WHERE eventID = '" . $row["ID"] . "'";
        $resultParticipant = $connect->query($sqlParticipant);
         
         if ($resultParticipant->num_rows > 0) {
         
        }

    ?>

    <div class="container">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <h1><?php echo $row["Title"] ?></h1>
          <h3><?php echo $row["eventDate"] ?></h3>
        </div>
        <div class="flip-card-back">
          <?php
           $counter = 0;
           while($rowParticipant = mysqli_fetch_assoc($resultParticipant)) {
            // print_r($rowParticipant);
            $sqlParticipantName = "SELECT * FROM login WHERE loginId = '" . $rowParticipant["participantID"] . "'";
            $resultParticipantName = $connect->query($sqlParticipantName);

             while($rowParticipantName = mysqli_fetch_assoc($resultParticipantName)) {
             $name = $rowParticipantName['FirstName'] . ' ' . $rowParticipantName['LastName'];

           ?>
              <h1><?php echo $name; ?></h1> 
              
          <?php
            $counter++;
            }
        }
        ?>
        </div>
      </div>
      </div>
   </div>
  <?php
  }
  ?>
    
</div> 

<?php
}
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
  include $_SERVER['DOCUMENT_ROOT']."/admin/parts/footer.php";
?>