<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		<script src="jquery-2.2.3.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#enterIdToViewProfile").click(function(){
                $("#enterIdToViewProfile").val('');
            });
        });
        
        </script>
        
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html" ?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
                
                
            <?php
            include 'dbconnect.php';
            $userName = isset($_POST['userName'])?$_POST['userName']:'';
            $password = isset($_POST['password'])?$_POST['password']:'';
            
            if(empty($_SESSION['UserId']) )
            {
                if(empty($userName) || empty($password))
                {
                    header("Location: Login.php"); /* Redirect browser */
                    exit();
                }
                else
                {
                    $authenticateUser = "SELECT USERID FROM USER_ WHERE USERNAME = '$userName' AND  PASSWORD='$password'";
                    $user = oci_parse($conn, $authenticateUser);
                    $userData = oci_execute($user);
                    $userDataRow = oci_fetch_row($user); //echo $userDataRow[0];
                    if(!$userDataRow)
                    {
                        header("Location: Login.php"); /* Redirect browser */
                        exit();
                    }
                    else
                    {
                        $UserId = $userDataRow[0];
                        $_SESSION['UserId']=$UserId;
                    }                    
                }
            }
            else
            {
                $UserId = $_SESSION['UserId'];
            }
                    

                    $queryUser_="SELECT USERID, NAME, EMAIL FROM USER_ WHERE USER_.USERID = $UserId ";

                    //$getUserId = "SELECT USERID FROM USER_ WHERE USERNAME = '$userName'";
                    //$UserIdQuery = oci_parse($conn, $getUserId);
                    //$UserIdData = oci_execute($UserIdQuery);
                    //$UserIdDataRow = oci_fetch_array($UserIdQuery, OCI_BOTH);

                    //if(isset($_SESSION['idFromSp']))
                     //   { $userId = $_SESSION['idFromSp'];} else
                      //  {$userId = $UserIdDataRow[0]; }

                    $queryStudent ="SELECT YEAR, SEMESTER, GPA, DEGREESTATUS, DEGREETYPE, JOBS, BONUSCREDIT, SHOWGPA, SHOWGROUPCLUB, SHOWCOURSEINTERESTGROUP, NUMOFCOURSES FROM STUDENT WHERE STUDENT.STUDENTID = $UserId";

                    $userTable = oci_parse($conn,$queryUser_);
                    $studentTable = oci_parse($conn,$queryStudent);

                    $userTableData = oci_execute($userTable);

                    $studentTableData = oci_execute($studentTable);


                    if(!$studentTableData)
                    {
                        echo "Something Wrong";
                    }else
                    {
                        //echo "All OK.";
                    }

                    $userTableDataROW = oci_fetch_array($userTable, OCI_BOTH);

                    if(!$userTableDataROW){}
                        else{
                        // echo "Row Retrieved."; 
                                                // echo $userTableDataROW[0]; 
                                                 // echo $userTableDataROW[1];
                                                 // echo $userTableDataROW[2];
                        }
                   $studentTableDataROW = oci_fetch_array($studentTable, OCI_BOTH);
                    if(!$studentTableDataROW){}else
                    {
                        // echo $studentTableDataROW[0]."\n";
                         //   echo $studentTableDataROW[1]."\n";
                         //   echo $studentTableDataROW[2]."\n";
                         //   echo $studentTableDataROW[3]."\n";
                         //   echo $studentTableDataROW[4]."\n";
                         //   echo $studentTableDataROW[5]."\n";
                         //   echo $studentTableDataROW[6]."\n";
                         //   echo $studentTableDataROW[7]."\n";
                         //   echo $studentTableDataROW[8]."\n";
                         //   echo $studentTableDataROW[9]."\n";
                         //   echo $studentTableDataROW[10]."\n";
                    }                                                                                                     
            
            ?>
            
            <section>
            <table>
            <tr><td><a href="Course.php"><input type="button" value="Register To Courses" name="courses" ></a></td>              
                <td><a href="ViewMyCourses.php"><input type="button" value="View My Courses" name="ViewCourses" ></a></td>
                <td><a href="ManageMyCourses.php"><input type="button" value="Manage My Courses" name="ManageCourses" ></a></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
		<!--<tr><td><a href="DF.php">Create Discussion Forum For Courses</a></td>
            </tr>-->  
            
            <tr><td><a href="CourseInterestGroup.php"><input type="button" value="Register to Course Interest Groups" name="interestGroup"></a></td>
                <td><a href="ViewMyCIG.php"><input type="button" value="View My Course Interest Groups" name="ViewIGC"></a></td>
                <td><a href="ModeratorCIG.php"><input type="button" value="Manage My Course Interest Groups"></a></td>
            </tr>
                <tr><td>&nbsp;</td></tr>
		<!--<tr><td><a href="IGDF.php">Create Discussion Forum For Interest Groups/Clubs</a></td>
            </tr>-->
            
            <tr><td><a href="InterestGroupClub.php"><input type="button" value="Register to Interest Groups/Clubs" name="Regclubs" ></a></td>
                <td><a href="ViewMyIGC.php"><input type="button" value="View My Interest Groups/Clubs" name="ViewClubsclub" ></a></td>
                <td><a href="ModeratorIGC.php"><input type="button" value="Manage My Interest Groups/Clubs"></a></td>
            </tr> 
                <tr><td> &nbsp</td></tr>
            <tr>
                <td><a href="FilterCIGComments.php"><input type="button" value="Filter Course Interest Group Comments" name="filterCIGcomments" ></a></td>
                <td><a href="FilterIGCComments.php"><input type="button" value="Filter Interest Group/Club Comments" name="filterIGCcomments" ></a></td>
            </tr>
                <tr><td> &nbsp</td></tr>
        </table>
                </section>
            <form action="searchPeople.php" method="post">
            <center><input type="text" value="Enter ID to View Profile" name="searchBoxValue" id="enterIdToViewProfile">
                 
                <input type="submit" value="submit"></center><br>
            </form>   
            
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
                
                <table>
                    <tr><th>Student ID:</th><td><input type="text" name="studentId" value="<?php echo (isset($userTableDataROW[0]))?$userTableDataROW[0]:'';?>"></td></tr>
                    <tr><th>Name:</th><td><input type="text" name="name" value="<?php echo (isset($userTableDataROW[1]))?$userTableDataROW[1]:'';?>"></td></tr>
                    <tr><th>Email:</th><td><input type="text" name="email" value="<?php echo (isset($userTableDataROW[2]))?$userTableDataROW[2]:'';?>"></td></tr>
                    <tr><th>Year joined:</th><td><input type="text" name="yearJoined" value="<?php echo isset($studentTableDataROW[0])?$studentTableDataROW[0]:'';?>"></td></tr>
                    <tr><th>Semester started:</th><td><input type="text" name="semesterStarted" value="<?php echo isset($studentTableDataROW[1])?$studentTableDataROW[1]:'';?>"></td></tr>
                    <tr><th>GPA:</th><td><input type="text" name="gpa" id="gpa" value="<?php echo isset($studentTableDataROW[2])?$studentTableDataROW[2]:'';?>" ></td></tr>
                    <tr><th>Degree Status:</th><td><input type="text" name="degreeStatus" value="<?php echo isset($studentTableDataROW[3])?$studentTableDataROW[3]:'';?>"></td></tr>
                    <tr><th>Degree Type:</th><td><input type="text" name="degreeType" value="<?php echo isset($studentTableDataROW[4])?$studentTableDataROW[4]:'';?>"></td></tr>
                    <tr><th>Jobs:</th><td><input type="text" name="jobs" value="<?php echo isset($studentTableDataROW[5])?$studentTableDataROW[5]:'';?>"></td></tr>
                    <tr><th>Bonus Credit:</th><td><input type="text" name="bonusCredit" value="<?php echo isset($studentTableDataROW[6])?$studentTableDataROW[6]:'';?>"></td></tr>
                    <tr><th>Number of Courses:</th><td><input type="text" name="numberOfCourses" value="<?php echo isset($studentTableDataROW[10])?$studentTableDataROW[10]:'';?>"></td></tr>
                    <tr><th>Show GPA:</th><td><input type="text" name="showGpa" value="<?php echo isset($studentTableDataROW[7])?$studentTableDataROW[7]:'';?>"></td></tr>
                    <tr><th>Show Group Club</th><td><input type="text" name="showGroupClub" value="<?php echo isset($studentTableDataROW[8])?$studentTableDataROW[8]:'';?>"></td></tr>
                    <tr><th>Show Course Interest Group</th><td><input type="text" name="showInterestGroup" value="<?php echo isset($studentTableDataROW[9])?$studentTableDataROW[9]:'';?>"></td></tr>
                </table>                                                                                              
				
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