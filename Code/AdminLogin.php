<?php
session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Admin Login </title>
		<center><code>Admin Login Form Below.</code></center>
		
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html" ?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="WelcomeToBackEnd.php" method="post">
					User ID:<br>
					<input type="text" name="userId" ><br>
					Password:<br>
					<input type="Password" name="password"><br>
					<input type="submit" value="Submit">
				</form>
				
			</div>
		</section>
		
	<!-- More navigation options can be included here. -->
		<nav class="secondNav">
		
		</nav>
		
	<!-- This place can contain messages or buttons. -->	
		<footer>
		
		</footer>
	</body>
</html>