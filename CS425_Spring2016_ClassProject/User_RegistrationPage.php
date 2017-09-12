


<!DOCTYPE html>
<html>
	<head>
		<title> Student Registration </title>
		<center><code>Set Username and Password</code></center>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<header>
		
		</header>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
        
		<section>
            
			<div class="divInSection">
                
				<?php
                
                $studentOrFaculty = $_POST['studentorfaculty'];    
                if($studentOrFaculty=='Student')
                {
				    echo '<form action="StudentRegistrationPage.php" method="post">';
                }
                else
                {
                    echo '<form action="FacultyRegistrationPage.php" method="post">';
                }
                    ?>
				<table align="center;">
<!--					<tr><td>User ID:</td><td><input type="number" name="userId" align="right"><td></tr>-->
					<tr><td>Email: </td><td><input type="text" name="email"><td></tr>
					<tr><td>Name: </td><td><input type="text" name="name"><td></tr>
					<tr><td>Username: </td><td><input type="text" name="userName"><td></tr>
					<tr><td>Password: </td><td><input type="password" name="passWord"><td></tr>
					<tr><td colspan="2">
                        <input type="submit" name="submit" value="Submit Data"></td></tr>
					</table>
				
                
<!--
                <a href="StudentRegistrationPage.php">Go to Student Registration Page 2</a><br>
                <a href="FacultyRegistrationPage.php">Go to Faculty Registration Page 2 </a>
-->
				
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


