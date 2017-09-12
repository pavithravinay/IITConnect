<?php
// Start the session
session_start();
$userId = $_SESSION['UserId'];
?>
<!DOCTYPE html>
<html>
	<head>
    
    </head>
    <body>
        <?php include "navbar.html" ?>
        <section>
                <!--Display list of Courses for the faculty to choose from-->
				<form action="InsertTAdata.php"  method="post">
                    <table>
                        <tr>
                            <td>
                                Select a Student below to Assign as TA:  
                            </td>                        
                        </tr>
                    
                    </table>
                    
                    
                    <?php
                        include 'dbconnect.php';
                        $courseID = $_GET['courseId'];
                        $sql = oci_parse($conn, "SELECT distinct s.studentID
                                                    FROM STUDENT s WHERE s.studentID 
                                                    NOT IN (SELECT studentID FROM Enrolled WHERE courseID = $courseID) AND
                                                    s.studentID NOT IN (SELECT s.studentId from Assists INNER JOIN Student s ON TAID=s.studentId WHERE courseid=$courseID)"); 
                    $_SESSION['courseId'] = $courseID;
                   
                    
                        if (!$sql) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$sql) {
                        $sqlResult = oci_execute($sql);
                        if (!$sqlResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        echo'<select name="studentListddl">';
                        echo'<option selected="selected">select a Student</option>';

                        while ($output = oci_fetch_array($sql,OCI_BOTH))
                        {
                               $studentId = $output[0];                                              
                            echo '<option value="' . ($studentId !== null ? htmlentities($studentId,ENT_QUOTES):"&nbsp") . '">' 
                                . ($studentId !== null ? htmlentities($studentId,ENT_QUOTES):"&nbsp"). 
                                '</option>';                                          

                        }
                        echo"</select>";
                        oci_free_statement($sql); 
                     ?>   
                    <table>
                        <tr>                           
                                <input type="submit" value="Assign" name="submit">                           
                        </tr>
                        
                    </table>
                    
                </form>				
			</section>		
        </body>
</html>
    
   
    