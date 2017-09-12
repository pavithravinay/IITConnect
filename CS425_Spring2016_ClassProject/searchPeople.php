<?php
session_start();
?>

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
            
           
            
             <?php
            include 'dbconnect.php';
            
             $_SESSION['userIdSp']= $_SESSION['UserId'];
                 //echo $_SESSION['userIdSp'];
            
            $_SESSION['idFromSp'] = isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:'';
            
            $userId = isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:$_POST['idList'];
       
            $queryUser_="SELECT USERID, NAME, EMAIL FROM USER_ WHERE USER_.USERID = $userId ";
            $queryStudent ="SELECT YEAR, SEMESTER, GPA, DEGREESTATUS, DEGREETYPE, JOBS, BONUSCREDIT, SHOWGPA, SHOWGROUPCLUB, SHOWCOURSEINTERESTGROUP, NUMOFCOURSES FROM STUDENT WHERE STUDENT.STUDENTID = $userId";
            
            $queryFaculty ="SELECT YEAR, POSITION, EXPERIENCE, PROJECTS FROM FACULTY WHERE FACULTY.FACULTYID = $userId";
            
            $userTable = oci_parse($conn,$queryUser_);
            $studentTable = oci_parse($conn,$queryStudent);
            
            $facultyTable = oci_parse($conn, $queryFaculty);
            
            
            
            $userTableData = oci_execute($userTable);
            
            $studentTableData = oci_execute($studentTable);
            
            $facultyTableData = oci_execute($facultyTable);
            
            if(!$studentTableData and !$facultyTableData)
            {
                echo "Something Wrong";
            }else
            {
                //echo "All OK.";
            }
            
            
            
            $userTableDataROW = oci_fetch_array($userTable, OCI_BOTH);
           $studentTableDataROW = oci_fetch_array($studentTable, OCI_BOTH);
            $facultyTableDataRow = oci_fetch_array($facultyTable, OCI_BOTH);
            
            
            
            ?>
            
		</nav>
        
        <section>
			<div class="divInSection">
			    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                Select an ID below.
                    <?php
                        include 'dbconnect.php';
                    $query = "SELECT USERID FROM USER_";
                    $selectIDList = oci_parse($conn, $query);
                    
                    if(!$selectIDList){
                        $e = oci_error();
                        echo $e;
                    }
                    
                    $idListResult = oci_execute($selectIDList);
                    
                      if (!$idListResult) {
                          $e = oci_error();
                          echo $e; 	
                        }     
                        
                     echo'<select name="idList">';
                     echo'<option selected="selected">select an ID</option>';
                     while ($idList = oci_fetch_array($selectIDList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {
                         foreach($idList as $id)
                            {      
                             echo '<option value="' . ($id !== null ? htmlentities($id,ENT_QUOTES):"&nbsp") . '">'
                                    . ($id !== null ? htmlentities($id,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                     echo"</select>";
                     oci_free_statement($selectIDList); 
                    ?>
                    
                <input type="submit" value="Search" name="submit">
                </form>
                
                <table>
                    <tr><th>ID:</th><td><input type="text" name="studentId" value="<?php echo (isset($userTableDataROW[0]))?$userTableDataROW[0]:'';?>"></td>
                    </tr>
                    <tr><th>Name:</th><td><input type="text" name="name" value="<?php echo (isset($userTableDataROW[1]))?$userTableDataROW[1]:'';?>"></td></tr>
                    <tr><th>Email:</th><td><input type="text" name="email" value="<?php echo (isset($userTableDataROW[2]))?$userTableDataROW[2]:'';?>"></td></tr>
                    <tr><th>Year joined:</th><td><input type="text" name="yearJoined" value="<?php echo isset($studentTableDataROW[0])?$studentTableDataROW[0]:'';?>"></td>
                    <th>Year Joined:</th><td><input type="text" name="yearJoined" value="<?php echo (isset($facultyTableDataRow[0]))?$facultyTableDataRow[0]:'';?>"></td>
                    
                    </tr>
                    <tr><th>Semester started:</th><td><input type="text" name="semesterStarted" value="<?php echo isset($studentTableDataROW[1])?$studentTableDataROW[1]:'';?>"></td>
                    
                    <th>Position: </th><td><input type="text" name="position" value="<?php echo (isset($facultyTableDataRow[1]))?$facultyTableDataRow[1]:'';?>"></td>
                    
                    </tr>
                    <tr><th>GPA:</th><td><input type="text" name="gpa" id="gpa" value="<?php /* echo isset($studentTableDataROW[2])?$studentTableDataROW[2]:'';*/
                        if($studentTableDataROW[7] == 'Y' ||$studentTableDataROW[7] == 'y' ){ 
                            echo $studentTableDataROW[2];
                        }else
                        {
                            echo "---Private Information---";
                        }
                        ?>" ></td>
                    
                    <th>Experience:</th><td><input type="text" name="experience" value="<?php echo (isset($facultyTableDataRow[2]))?$facultyTableDataRow[2]:'';?>"></td>
                        
                    </tr>
                    <tr><th>Degree Status:</th><td><input type="text" name="degreeStatus" value="<?php echo isset($studentTableDataROW[3])?$studentTableDataROW[3]:'';?>"></td>
                    
                    <th>Projects: </th><td><input type="text" name="projects" value="<?php echo (isset($facultyTableDataRow[3]))?$facultyTableDataRow[3]:'';?>"></td>
                    
                    </tr>
                    <tr><th>Degree Type:</th><td><input type="text" name="degreeType" value="<?php echo isset($studentTableDataROW[4])?$studentTableDataROW[4]:'';?>"></td></tr>
                    <tr><th>Jobs:</th><td><input type="text" name="jobs" value="<?php echo isset($studentTableDataROW[5])?$studentTableDataROW[5]:'';?>"></td></tr>
                    <tr><th>Bonus Credit:</th><td><input type="text" name="bonusCredit" value="<?php echo isset($studentTableDataROW[6])?$studentTableDataROW[6]:'';?>"></td></tr>
                    <tr><th>Number of Courses:</th><td><input type="text" name="numberOfCourses" value="<?php echo isset($studentTableDataROW[10])?$studentTableDataROW[10]:'';?>"></td></tr>
                    <tr><th>Show GPA:</th><td><input type="text" name="showGpa" value="<?php echo isset($studentTableDataROW[7])?$studentTableDataROW[7]:'';?>"></td></tr>
                    <tr><th>Show Group Club</th><td><input type="text" name="showGroupClub" value="<?php echo isset($studentTableDataROW[8])?$studentTableDataROW[8]:'';?>"></td></tr>
                    <tr><th>Show Course Interest Group</th><td><input type="text" name="showInterestGroup" value="<?php echo isset($studentTableDataROW[9])?$studentTableDataROW[9]:'';?>"></td></tr>
                </table>
                
           
                 <table>
                 <form action="" method="post">
            <tr><td><a href="Course.php"><input type="button" value="My Courses" name="courses" id="courses"></a></td></tr>    
                </form>   
                     <tr><td>&nbsp;</td></tr>
                     
                <form action="ViewMyCIG_SP.php" method="post">
                    <input type="hidden" name="myCig" value="<?php echo isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:$_POST['idList']; ?>">
                  <?php  $_SESSION['myCig'] = isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:$_POST['idList']; ?>
            <tr><td><a href="ViewMyCIG_SP.php"><input type="button" value="Course Interest Groups" name="courseInterestGroups" id="courseInterestGroups" 
             <?php
            if(isset($studentTableDataROW[9])) {                                      
              if($studentTableDataROW[9] == 'N' || $studentTableDataROW[9] == 'n')                                         
                echo 'disabled="disabled"';    
            }
            ?>                                           
                                                       
             ></a></td>
            </tr>
             <tr><td>&nbsp;</td></tr>       
            </form>     
                     
            <form action="ViewMyIGC_SP.php" method="post">
             <input type="hidden" name="myIgc" value="<?php echo isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:$_POST['idList']; ?>">
                  <?php  $_SESSION['myIgc'] = isset($_POST['searchBoxValue'])?$_POST['searchBoxValue']:$_POST['idList']; ?>   
            <tr><td><a href="ViewMyIGC_SP.php"><input type="button" value="Interest Group Or Club" name="interestGroupOrClub" id="interestGroupOrClub"
            <?php      
           if(isset($studentTableDataROW[8])) { 
              if($studentTableDataROW[8] == 'N' || $studentTableDataROW[8] == 'n') 
                  echo 'disabled="disabled"';  
           }
            ?>                                  
          ></a></td>
            </tr>
                <tr><td>&nbsp;</td></tr> 
            </form>            
        </table>
                
                <a href="Profile.php">Go to Home Page.</a>
                
				
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