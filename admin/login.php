<!-- этот файл РНР выводит модальное окно авторизации -->
<!-- подключаем базу данных -->

<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";

  // проверяем существуют ли POST-запросы созданные формой 
  // авторизации, а также не являются ли они пустыми
  if(isset($_POST["uname"]) && isset($_POST["psw"])
    && $_POST["uname"] != "" && $_POST["psw"] != ""
  ){
    //если да, то создаем запрос для базы данных, в которым получаем из БД
    // пользователя с указанными почтой и паролем
    $sql = "SELECT * FROM admin WHERE userName LIKE '" . $_POST["uname"] ."' AND password LIKE '" . $_POST["psw"] . "'";
    // получаем данные из таблицы messageslist по условиям запроса
    $result = mysqli_query($connect, $sql);

    // получаем количестов рядов в полученном ответе
    $resultQuantity = mysqli_num_rows($result);
    
    // и если пользователь существует, а он может быть только один
    // так как сочетание почты и пароля уникальны
    if($resultQuantity == 1) {
      $user = mysqli_fetch_assoc($result);
      // создаем куки для хранения id залогиненнго польжователя
      setcookie("user_id", $user["id"], time()+ 10000, "/");

      print_r($page);
    
    
      // переходим на главную страницу
      header("Location: /admin/index.php");
    }
  }
  ?>

<div id="id01" class="modal">
  
  <form class="modal-content animate"  method="POST">
    
    <div class="container">
      <label for="uname"><b>Имя пользователя</b></label>
      <input type="text" placeholder="Введите имя пользователя" name="uname" required>

      <label for="psw"><b>Пароль</b></label>
      <input type="password" placeholder="Введите пароль" name="psw" required>
        
       <div class="container">
        <button type="submit">Войти</button>
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Отмена</button>
      </div>
     
    </div>

   
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

