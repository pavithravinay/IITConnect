<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		
		
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
				<?php
                $courseId = $_POST['courseId'] ;
                $taId = $_POST['taListddl'];
                
               // echo $_POST['courseId']; echo "\n";
               // echo $_POST['taListddl'];
                
                include 'dbconnect.php';
                
                $queryGroupID = "SELECT GROUPID FROM COURSE_HAS WHERE COURSEID =  
               $courseId";
                
                $groupId = oci_parse($conn, $queryGroupID);if(!$groupId)
                {
                    //echo "Wrong";
                }
                else{
                    //echo "right";
                }
                $groupIdData = oci_execute($groupId);if(!$groupIdData)
                {
                    //echo "Wrong";
                }
                else{
                   // echo "right";
                }
                $groupIdDataRow = oci_fetch_array($groupId, OCI_BOTH);if(!$groupIdDataRow)
                {
                    //echo "Wrong";
                }else
                {
                    //echo "right";
                }
                
               
                
                $queryAssignMod = "INSERT INTO MODERATESCIG(MODID, GROUPID) VALUES($taId,$groupIdDataRow[0])";
                
                $assignMod = oci_parse($conn, $queryAssignMod); if(!$assignMod)
                {
                    //echo "Wrong";
                }else{
                    //echo "right";
                }
                $assignModData = oci_execute($assignMod);if(!$assignModData)
                {
                    //echo "Wrong";
                }
                else
                {
                    //echo "right";
                }
//                $assignModDataRow = oci_fetch_array($assignMod, OCI_BOTH);if(!$assignModDataRow){echo "Wrong";}else{echo "right";}
                
                
                
                
                ?>
				
				
			</div>
            <a href="WelcomeToBackEnd.php">Go to admin home page.</a>
		</section>
		
	<!-- More navigation options can be included here. -->
		<nav class="secondNav">
		
		</nav>
		
	<!-- This place can contain messages or buttons. -->	
		<footer>
		
		</footer>
	</body>
</html>