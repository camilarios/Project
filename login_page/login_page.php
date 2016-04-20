<html lang="en">
	<head>	
	</head>
	
	<?php /*just to make it work, because I couldn't put it on the real project*/
		include "css.php";
	?>
	
	<body>
		<div id="logo">
			<img src="imgs/login/nct_logo.png" alt="logo" style="width:350px;height:174px;">
		</div>
		
		<div id="main_box" >
			<form class="login">
				<label for="username">login:</label>
				<input type="text" name="name" id="username" placeholder="  username" p style="color:#0d6f67"><br>
				<label for="password">password:</label>
				<input type="password" name="pwd" id="password" placeholder="  password" p style="color:#0d6f67"><br>
				<input type="submit" value="sing in">
			</form>
		</div>
	</body>
	</html>