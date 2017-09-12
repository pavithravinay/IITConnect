<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html"?>
		
	 
	<!-- Forms can be made here. -->	
		<section>			            
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">                      
                    
                    <?php                                    
                        include 'dbconnect.php'; 
                        $commentId = $_SESSION['CID'];
                    //echo $commentId;
                        //$comment = isset($_POST['comment'])?$_POST['comment']:'';                        
                    
                        $sql = oci_parse($conn,"DELETE FROM comments WHERE commentId = $commentId");                    

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
                            echo 'You have successfully Deleted the comment.';
                        }
                        
                        oci_free_statement($sql);                    
                   
                ?>
                    <!-- Todo: Check what should be the home page.-->
                    <br>
                    <a href="Profile.php">Go to home page</a>
                </form>               
		</section>
  
	</body>
</html>