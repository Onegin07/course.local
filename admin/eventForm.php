<form name='eventform' method='POST' action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month;?>&day=<?php echo $day;?>&year=<?php echo $year; ?>&v=true&add=true">
	<div class="eventform">
		<label>Title              </label>
		<input type='text' name='txttitle'>
			
		<label>Details</label>
		<textarea name='txtdetail'></textarea>
	</div>
	<div colspan='2' align='center'><input type='submit' name='btnadd' value='Add Event'></div>
	
</form>

	