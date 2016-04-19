<div id="container7">
	<?php 
		if ($showInsertUserError == True || $showInsertUserEmailError == True || $showInsertUserPassError == True){
			$errorMsg = "<div class = 'alert alert-danger'>";
			$errorMsg2 = "</div>";
			echo $errorMsg;
			echo $errorInsertUserMsg;
			echo $errorMsg2;
		}
	?>
</div>

<form action="index.php" method="post">
	<h1>Register</h1>
	
	<div class="form-group">
		<label>First Name:</label> 
		<input type="text" name="name" placeholder="insert your first name" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>Surname: </label> 
		<input type="text" name="surname" placeholder="insert your surname" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>Email:</label> 
		<input type="email" name="email" placeholder="insert your email" required class="form-control">
	</div>
	
	<div class="form-group">
		<label>Password:</label> 
		<input type="password" name="password" required class="form-control">
	</div>
	
	<input type='hidden' name='action' value='insertUser'> 
	<input type="submit" value='Insert' class='btn btn-success'>
</form>
