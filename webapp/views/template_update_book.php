<div id="container7">
	<?php 
		if ($showUpdateBookError == True || $showUpdateBookError2 == True){
			$errorMsg = "<div class = 'alert alert-danger'>";
			$errorMsg2 = "</div>";
			echo $errorMsg;
			echo $errorUpdateBookMsg;
			echo $errorMsg2;
		}
	?>
</div>	

<form action="index.php" method="post">
	<h1>Update appointment</h1>
	
	<div class="form-group">
		<label>Booking Name:</label> 
		<input type="text" name="book_name" value="<?php echo $book_name;?>" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>mechanic:</label> 
		<input type="text" name="book_auth" value="<?php echo $book_auth;?>" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>Mechanic ID:</label> 
		<input type="text" name="book_categ" value="<?php echo $book_categ;?>" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>Date of completion :</label> 
		<input type="date" name="book_date" value="<?php echo $book_date?>" required class="form-control">
	</div>
	
	<input type="hidden" name="book_id" value="<?php echo $book_id;?>">
	<input type='hidden' name='action' value='updateBook'> 
	<input type="submit" value='Update' class='btn btn-success'>
</form>
<br>
<form class='pull-left'  action='index.php' method='post'>
	<input type='submit' class='btn btn-success' value='Cancel'>
	<input type='hidden' name='action' value='viewAll'>
</form>
