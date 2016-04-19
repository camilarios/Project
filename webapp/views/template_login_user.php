<div id="container4">
	<?php 
		if ($showLoginError == True){
			$errorMsg = "<div class = 'alert alert-danger'>";
			$errorMsg2 = "</div>";
			echo $errorMsg;
			echo $errorLoginMsg;
			echo $errorMsg2;
		}
	?>
</div>

<form action="index.php" method="post">
	<div class="navbar-form pull-right">
		<input type="text" name="name" placeholder="insert your first name" required class="form-control">
		<input type="password" name="password" placeholder="insert your password" required class="form-control">
		<input type='hidden' name='action' value='loginUser'> 
		<input type="submit" value='Log in' class='btn btn-success'>
	</div>
</form>
