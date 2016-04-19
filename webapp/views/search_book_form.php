<form action="index.php" method="post">
	<h1>Search </h1>
	<div>
		<input type="text" name="search_key" placeholder="appointment" required class="form-control">
		<br>
		<input type='hidden' name='action' value='searchBook'> 
		<input type="submit" value='Search' class='btn btn-success'>
	</div>
</form>