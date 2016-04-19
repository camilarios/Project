<!DOCTYPE html>
<html lang="en">
<!--CAMILA: Most mods here are just to be practical: logo is an exception-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">
		
		<title><?php echo $title;?></title>
		
		<!-- CSS -->
		<link href="styles/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
		<link href="styles/bootstrap-3.3.5-dist/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="styles/web_app_style.css" rel="stylesheet">
	</head>

	<body>
  		<nav class="navbar navbar-inverse navbar-fixed-top">
    		<div class="container">
    			<!-- when zoomed in, navbar menu buttons (if exists) will be all put in dropdown menu button sweet -->
        		<div class="navbar-header">
		          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
		          		data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            	<span class="sr-only">Toggle navigation</span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		          	</button>
        		</div>
        		
        		<div id="navbar" class="collapse navbar-collapse">
          			<ul class="nav navbar-nav">
						<!--CAMILA: LOGO IN THE LEFT CORNER!! -->
          				<li class="active"><a class="navbar-brand" href="#"><img src="./imgs/admin/nct_logo_navbar.png" alt="logo" style="width:inherit;height:inherit;"></a></li>
          			</ul>
          			
          			<div id="container3" >
						<?php
							if($loginFormVisible)
								//appears when no user is logged in
								include ("template_login_user.php");
							else
								
								//appears when user is logged in
								include ("user_acount.php");
						?>
					</div>
				</div>
        	</div>
    	</nav>

    	<div class="container">
      		<div class="starter-template">
      			<br><br>
        		<div class="col-md-3">	
        			<br>
        			<?php
        				//always show search form
        				include ("search_book_form.php");
        				
        				if($loginFormVisible == false){
        					if ($updateBookFormVisible){
        						//only appears if user is logged in and when the update button is pressed
								include ("template_update_book.php");
        					}
        					else{
        						//appears when user is logged in and not doing any book updates
        						include ("template_side_menu.php");
        					}

        				}
        				else{
        					//appears if there is no logged in user
							include ("template_new_user.php");
        				}
					?>
        		</div>
      		</div>
      		
      		<div id="container2">
				<?php
					//user is not logged in
					if($loginFormVisible)
						if($searchListVisible)
							//shows the searched book list without update and delete options
							include ("searched_book_all_user.php");
						else
							//shows the entire book list without update or delete options
							include ("all_user.php");
					//user is logged in
					if($loginFormVisible == false)
						if($searchListVisible)
							//shows the searched book list with update and delete options
							include ("searched_book.php");
						else
							if (isset($_GET['menu_choice']))  {
								switch($_GET['menu_choice']){
								
									case 'VIEW ALL APPOINTMENTS';
										include ("logged_user.php");
										break;
		
									case 'BOOK APPOINTMENT';
										include ("add_edit_app.php");
										break;
										
									case 'VIEW TEST RESULTS';
										include ("test_results.php");
										break;
										
									case 'SETTINGS';
										include ("settings_admin.php");
										break;
								}
		
							}else if (isset($_GET['settings_choice']))  {
									switch($_GET['settings_choice']){
													
										case 'MECHANICS';
												include ("mechanics.php");
												break;
						
										case 'CHANGE LOGIN';
												include ("change_login.php");
												break;
														
										case 'CHANGE PASSWORD';
												include ("change_pwd.php");
												break;
													
									}
							}else
								include ("logged_user.php");

				?>
			</div>
    	</div>
    	
    	<br><br>
    	<div id="footer">
    		<br>
			<div class="container"><?php echo $footer;?></div>
		</div>
  	</body>
</html>
