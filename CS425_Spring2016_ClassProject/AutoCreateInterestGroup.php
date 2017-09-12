<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<header>
		
		</header>
		
	 
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
                        }
                        
                        oci_free_statement($sql);                    
                   
                ?>
                    <!-- Todo: Check what should be the home page.-->
                    <a href="AdminLogin.php">Add more Courses</a>
                </form>               
		</section>
  
	</body>
</html>