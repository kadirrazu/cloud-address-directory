<?php 
/**
 * Project Title: Cloud Address Directory
 * Coded By: Md. Abdul Kadir
 * URL: http://www.kadirrazu.info
 * Description: Simple CRUD implementation using CorePHP and MySQL. This project follow simple security implementations to templating system using partials. It may be an ideal project for the beginers to dig in. 
 */
?>
<?php 
	session_start();

	if( isset($_SESSION["sess_logged_in"]) && $_SESSION["sess_logged_in"] == true )
	{
	    header("Location: directory-index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login : Address Directory</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    
    <div class="container">
    	<div class="col-md-12">
    		<div class="login-container">
    			
    			<div class="hints">
    				<p>
	    				<strong>
	    					Want to access this directory? Just a step away!
	    				</strong>
	    			</p>
	    			<p>
	    				First verify yourself as as a valid user
	    				<i class="fa fa-smile-o"></i>
	    			</p>
    			</div>

    			<?php 
    				require_once('flash-message.php');
    			?>

    			<form action="login-verifier.php" method="POST">
				  <div class="form-group">
				    <label for="email">Email address</label>
				    <input type="email" name="email" class="form-control"placeholder="Email">
				  </div>
				  <div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" name="password" class="form-control" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-default">
				  	Verify Me
				  </button>
				</form>

    		</div>

    		<div class="login-copy">
    			<p>
    				<strong>
    					&copy; 2016, IIT Demo App
    				</strong>
    			</p>
    		</div>
    	</div>
    </div>

    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>