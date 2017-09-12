
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html" ?>
		
	 
	<!-- Forms can be made here. -->	
		<section>			            
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">                      
                    
                    <?php                                    
                        include 'dbconnect.php'; 
                        $courseID = $_POST["courseIdIn"];
                        $title = $_POST["TitleIn"];
                    
                        $sql = oci_parse($conn,"INSERT INTO Course(ID,title) VALUES(:courseId_bv,:title_bv)");
                    
                        oci_bind_by_name($sql,":courseId_bv",$courseID);
                        oci_bind_by_name($sql,":title_bv",$title);

                        if (!$sql)
                        {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        $sqlResult = oci_execute($sql);
                        if (!$sqlResult)  
                        {
                          $e = oci_error();
                          echo $e; 	                                  
                        }
                        else
                        {
                            echo 'You have successfully added course.';
                            echo "<br>";
                        }
                        
                        oci_free_statement($sql); 
                        AutoCreateCIG();
                    
                        function AutoCreateCIG(){
                        include 'dbconnect.php'; 
                        $query = 'BEGIN courseInterestGroupCreator(); END;';
                        $sql = oci_parse($conn,$query);
                        if (!$sql)
                        {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        $sqlResult = oci_execute($sql);
                        if (!$sqlResult)  
                        {
                          $e = oci_error();
                          echo $e; 	                                  
                        }
                                               
                    }
                   
                ?>
                    <!-- Todo: Check what should be the home page.-->
                    <a href="AddCourses.php">Add more Courses</a><br><br>
                    <a href= "WelcomeToBackEnd.php">Go to home page</a>
                </form>               
		</section>
  
	</body>
</html>