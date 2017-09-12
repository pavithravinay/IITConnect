<!DOCTYPE html>
<html>
	<head>
		<title> Student or Faculty </title>
		<center><code>Please make a selection below.</code></center>
		
		
		
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
				
					Are you a Student or a Faculty?<br>
				<form action="User_RegistrationPage.php" method="post">
					I am a Student<input type="radio" value="Student" name="studentorfaculty"><br>
                    I am a Faculty<input type="radio" value="Faculty" name="studentorfaculty"><br>
                    <input type="submit" value="Submit" name="submit">
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