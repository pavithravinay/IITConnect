<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Course Enrollment </title>
		<center><code></code></center>
<!--		<link href="/CS425ProjectSpring2016/styles/css/site.css" rel="stylesheet" type="text/css">-->
		
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
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">                      
                    
                    <?php
                        $studentId = $_SESSION["userId"];
                        include 'dbconnect.php';
                                      
                        $courseId = $_POST['courseListddl'];                         
                        $sql = oci_parse($conn, "INSERT INTO Enrolled(StudentID, CourseID) VALUES(:studentId_bv, :groupId_bv)");

                                if (!$sql) {
                                  $e = oci_error();
                                  echo $e; 	
                                } 
                                oci_bind_by_name($sql,":studentId_bv",$studentId);
                                oci_bind_by_name($sql,":groupId_bv",$courseId);                            
                    

                                $sqlResult = oci_execute($sql);

                                if (!$sqlResult) {
                                  $e = oci_error();
                                 // echo $e; 	
                                  echo 'You have already enrolled into this course!!';
                                } 
                                else
                                {
                                    echo '<label>Congratulations!!! You have successfully enrolled into course.</label>';
                                }
                                oci_free_statement($sql); 
                        
                        
                ?>
                    <!-- Todo: Check what should be the home page.-->
                    <br><br>
                    <a href="Profile.php">Go to Home Page</a><br>
                    <a href="Course.php">Go here to register for more courese</a>
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