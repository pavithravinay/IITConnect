<?php // Start the session 
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
		<title> User Login </title>
		

	</head>
	
	<body>
	
		<!-- Navigation buttons can be included here. -->	
		<?php include "navbar.html" ?>
	
		
	<!-- Forms can be made here. -->	
		<section>
            <code>Please enter credentials below.</code>
			<div class="divInSection">
				
				<form action="Profile.php" method="post">
					User Name:<br>
					<input type="text" name="userName"><br>
					Password:<br>
					<input type="Password" name="password"><br>
					<input type="submit" value="Submit"  name="submit">
				</form>
				<a href="AdminLogin.php"><small>For Administrator Login, Click Here.</small></a><br>
				<a href="StudentOrFaculty.php"><small>New User? Click Here.</small></a>
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