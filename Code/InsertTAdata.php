<?php
// Start the session
session_start();
$courseID =  $_SESSION["courseId"];
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
                        
                        $sql = "INSERT INTO Assists(TAId,courseId) VALUES(:studentId_bv,:courseId_bv)";                         
                        
                        $studentId = $_POST['studentListddl'];
                        $studentIdIsTa = CheckIfStudentIsTa($studentId);
                            
                        if(!$studentIdIsTa)
                        {
                            InsertIntoTa($studentId);
                        }                    
                        
                        $courseID =  $_SESSION["courseId"]; 
                        $s2 = oci_parse($conn,$sql);
                        oci_bind_by_name($s2,":studentId_bv",$studentId);
                        oci_bind_by_name($s2,":courseId_bv",$courseID);

                        if (!$s2)
                        {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        $sqlResult = oci_execute($s2);
                        if (!$sqlResult)  
                        {
                          $e = oci_error();
                          echo $e; 	                                  
                        }
                        else
                        {
                            echo 'You have successfully assigned TA.';
                        }
                        
                        oci_free_statement($s2); 
                    
                    function CheckIfStudentIsTa($stId)
                    {
                        include 'dbconnect.php';     
                        $sql = "SELECT * FROM TA WHERE TAID=$stId";
                        $s1 = oci_parse($conn,$sql);
                        
                        if (!$sql) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$stid) {
                        $result = oci_execute($s1);
                        if (!$result) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        $results=array();
                        $numrows = oci_fetch_all($s1, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);

                        if ($numrows>=1)
                        {
                            return true;
                        }
                        else
                        {
                            return false;                                
                        }                        
                    }
                    
                    function InsertIntoTa($stId)
                    {                        
                        include 'dbconnect.php';     
                        $sql1 = "INSERT INTO TA(TAId) VALUES(:studentId_bv1)";
                        $s1 = oci_parse($conn,$sql1);
                        oci_bind_by_name($s1,":studentId_bv1",$stId);  
                        if (!$s1)
                        {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        $sqlResult1 = oci_execute($s1);
                        if (!$sqlResult1)  
                        {
                          $e = oci_error();
                          echo $e; 	                                  
                        }
                        
                        oci_free_statement($s1); 
                    }

                ?>
                    <!-- Todo: Check what should be the home page.-->
                    <a href="Profile.php">Go to Home Page</a>
                </form>               
		</section>
  
	</body>
</html>