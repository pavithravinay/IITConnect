<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Faculty Registration </title>
		<center><code>Create a Faculty Account.</code></center>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html"?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
            <?php
            include 'dbconnect.php';
            $email = isset($_POST['email'])?$_POST['email']:'';
            $name =  isset($_POST['name'])?$_POST['name']:'';
            $username =  isset($_POST['userName'])?$_POST['userName']:'';
            $password =  isset($_POST['passWord'])?$_POST['passWord']:'';


            if(isset($_POST['email'])?$_POST['email']:'')
            {

                $SelectUserId = "SELECT max(UserId) FROM User_";    

                $p1 = oci_parse($conn, $SelectUserId);
                $result = oci_execute($p1); 

                while($UserId = oci_fetch_row($p1))
                {
                    $UserIdnew = $UserId[0];
                    if($UserIdnew >=1)
                    {
                        $newUserId = intval($UserIdnew) + 1;
                    }
                    else
                    {
                        $newUserId = 1;
                    } 
                }

                $_SESSION['UserId'] = $newUserId;
                $query = "INSERT INTO USER_(USERID, EMAIL, NAME, USERNAME, PASSWORD) VALUES ($newUserId, '$email', '$name', '$username', '$password' )";    


                $userTable = oci_parse($conn, $query);

                $userTableData = oci_execute($userTable);

                    if(!$userTableData)
                    {
                        echo "Something Wrong";
                    }else
                    {
                        echo "Your Data is Submitted.";

                    }


            }
        ?>
			<div class="divInSection">
				
				<form action="handleFacultyRegistration.php" method="post">
					<table align="center;">					
					<tr><td>Year of Joining: </td><td><input type="number" name="year"><td></tr>
					<tr><td>Position : </td><td><input type="text" name="position"><td></tr>
					<tr><td>Experience : </td><td><input type="text" name="experience"><td></tr>
					<tr><td>Projects: </td><td><input type="text" name="projects"><td></tr>
					
					<tr><td colspan="2"><input type="submit" value="Register"></td></tr>
					</table>
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