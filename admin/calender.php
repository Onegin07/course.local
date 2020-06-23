<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT']."/configs/db.php";
?>
<html>
	<head>
		<link rel="stylesheet" href="/admin/stylesAdmin.css">

		<script>
		function goLastMonth(month, year){
			if(month == 1) {
				--year;
				month = 13;
		}
			--month
			var monthstring= ""+month+"";
			var monthlength = monthstring.length;
			
			if(monthlength <=1){
				monthstring = "0" + monthstring;
			}
			document.location.href ="<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
		}


		function goNextMonth(month, year){
			if(month == 12) {
				++year;
				month = 0;
			}
			++month
			var monthstring= ""+month+"";
			var monthlength = monthstring.length;

			if(monthlength <=1){
				monthstring = "0" + monthstring;
			}
			document.location.href ="<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
		}
		</script>
		
	</head>

	<body>
		<?php
			if (isset($_GET['day'])){
			$day = $_GET['day'];
			} else {
			$day = date("j");
			}
			if(isset($_GET['month'])){
			$month = $_GET['month'];
			} else {
			$month = date("n");
			}
			if(isset($_GET['year'])){
			$year = $_GET['year'];
			}else{
			$year = date("Y");
			}
			$currentTimeStamp = strtotime( "$day-$month-$year");
			$monthName = date("F", $currentTimeStamp);
			$numDays = date("t", $currentTimeStamp);
			$counter = 0;
			
			if(isset($_GET['add'])){
				$title =$_POST['txttitle'];
				$detail =$_POST['txtdetail'];
				$eventdate = $month."/".$day."/".$year;
				$sqlinsert = "INSERT INTO eventcalendar(Title,Detail,eventDate,dateAdded) VALUES ('".$title."','".$detail."','".$eventdate."',now())";
				$result = mysqli_query($connect, $sqlinsert);

				if($result) {
					echo "Event was successfully Added...";
				} else {
				echo "Event Failed to be Added....";
				}
			}
		?>
		<div class="main">
		<table border='1' class="calender">
			<tr>
				<td><input type='button' value='<'name='previousbutton' onclick ="goLastMonth(<?php echo $month.",".$year?>)"></td>
				<td colspan='5'><?php echo $monthName.", ".$year; ?></td>
				<td><input type='button' value='>'name='nextbutton' onclick ="goNextMonth(<?php echo $month.",".$year?>)"></td>
			</tr>

			<tr>
				<td class="cell">Sun</td>
				<td class="cell">Mon</td>
				<td class="cell">Tue</td>
				<td class="cell">Wed</td>
				<td class="cell">Thu</td>
				<td class="cell">Fri</td>
				<td class="cell">Sat</td>
			</tr>

			<?php
			echo "<tr>";
			for($i = 1; $i < $numDays+1; $i++, $counter++) {
				$timeStamp = strtotime("$year-$month-$i");

				if($i == 1) {
					$firstDay = date("w", $timeStamp);

					for($j = 0; $j < $firstDay; $j++, $counter++) {
						echo "<td>&nbsp;</td>";
					}
				}

				if($counter % 7 == 0) {
					echo"</tr><tr>";
				}
				$monthstring = $month;
				$monthlength = strlen($monthstring);
				$daystring = $i;
				$daylength = strlen($daystring);

				if($monthlength <= 1) {
					$monthstring = "0".$monthstring;
				}

				if($daylength <=1) {
					$daystring = "0".$daystring;
				}

				$todaysDate = date("m/d/Y");
				$dateToCompare = $monthstring. '/' . $daystring. '/' . $year;
				echo "<td align='center' ";

				if ($todaysDate == $dateToCompare) {
					echo "class ='today'";
				} else{
					$sqlCount = "SELECT * FROM eventcalendar WHERE eventDate='".$dateToCompare."'";
					$noOfEvent = mysqli_num_rows(mysqli_query($connect, $sqlCount));

					if($noOfEvent >= 1) {
						echo "class='event'";
					}
				}
				echo "><a href='".$_SERVER['PHP_SELF']."?month=".$monthstring."&day=".$daystring."&year=".$year."&v=true'>".$i."</a></td>";
			}
			echo "</tr>";
			?>
		</table>
		
		<?php
		if(isset($_GET['v'])) {
			
				include("eventForm.php");
			// $sqlEvent = "SELECT * FROM eventcalendar WHERE eventDate='".$month."/".$day."/".$year."'";
			// $resultEvents = mysqli_query($connect, $sqlEvent);
			// echo "<hr>";

			// while ($events = mysqli_fetch_array($resultEvents)){
			// 	echo "Title: ".$events['Title']."<br>";
			// 	echo "Detail: ".$events['Detail']."<br>";
			// }
		}
		?>
		<div style="margin-top: 40px;">
			<a class="button" href="/admin/pages/events.php">Назад</a>
		</div>
	</div>
	</body>
</html>