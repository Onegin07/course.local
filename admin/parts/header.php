<!-- где хранятся начальные строки кода, общие для всех -->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/admin/stylesAdmin.css">
<link rel="stylesheet" href="/admin/stylesAdminLogin.css">
<link rel="stylesheet" href="/admin/stylesAdminCards.css">

</head>
<body>
	<div id="header">
		<div class="login">
			<?php
				// проверяем залогинился ли admin
				if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] ==1) {
			?>
				<!-- если да, то в меню выводим ссылку на выход -->
					<a href="/chat/index.php" id="open-login">ЧАТ
						<div id="exit">
							<img src="/images/chatAdmin1.png">
						</div>
					</a>

					<a href="/admin/exit.php" id="open-login">АДМИН
						<div id="exit">
							<img src="/images/exit1.jpg">
						</div>
					</a>
			<?php
				} else {
			?>
	    		<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
	    	<?php
				}
			?>
	  	</div>
	</div>
<?php
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/login.php";
  // подключаем footer.php, где хранятся заключительные строки кода, общие для всех
	include $_SERVER['DOCUMENT_ROOT']."/admin/parts/sideNavMenu.php";
?>