<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Admin Functions </title>
		<center><code>Select an Operation Below.</code></center>
		
		
	</head>
	
	<body>
        
        
        
        <?php
        if (empty($_SESSION['isAdmin']))
        {
            $username = isset($_POST['userId'])?$_POST['userId']:'';
            $password = isset($_POST['password'])?$_POST['password']:'';
             if($username == 'admin' AND $password == 'pass123')
             {
                 $_SESSION['isAdmin'] = 'Yes';
             }
            else 
            {
                 header('Location: AdminLogin.php');
            }
        }

        

         ?>
        
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html" ?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
			
				<form action="Insert.php">
				<input type="submit" value="Insert">
                </form>
                <br>
                <form action="UpdateData.php">
                <input type="submit" value="Update">
                </form>
                <br>
                <form action="Delete.php">
                <input type="submit" value="Delete">
				</form>
                <br>
                <form action = "AssignModerator.php">
                <input type="submit" value="Assign Moderators to Course Interest Group">
                </form>
                <br>
                <form action="AssignModToIGC.php">
                <input type="submit" value="Assign Moderators to Interest Group or Club">
                </form>
                <br>
                <form action = "AddCourses.php">
                <input type="submit" value="Add Courses">
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