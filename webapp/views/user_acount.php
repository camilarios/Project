<div id="container5" > 
	<form action="index.php" method="post">
		<div class="navbar-form pull-right">
			<input type='hidden' name='action' value='logoutUser'> 
			<input type="submit" value='Log out' class='btn btn-success'>
		</div>
	</form>
	
	<div class="pull-right">
		<ul class="nav navbar-nav">
	    	<li class="active"><a class="navbar-brand"><?php echo $user_name; ?></a></li>
	   	</ul>
	</div>
</div>