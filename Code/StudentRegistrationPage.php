
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Student Registration </title>
		<center><code>Create a Student Account.</code></center>
		
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<header>
		
		</header>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->
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


                $query = "INSERT INTO USER_(USERID, EMAIL, NAME, USERNAME, PASSWORD) VALUES ($newUserId, '$email', '$name', '$username', '$password' )";    

                $_SESSION['userId'] = $newUserId;
                $userTable = oci_parse($conn, $query);

                $userTableData = oci_execute($userTable);

                    if(!$userTableData)
                    {
                        echo "Something Wrong";
                    }
                
            }
        
        function getCourseList()
        {
            include 'dbconnect.php';
            $sql = oci_parse($conn,"SELECT id,title FROM Course");
            $result = oci_execute($sql);
            
            $result = array();
            $count = 0;
            while($row = oci_fetch_array($sql,OCI_BOTH))
            {
                $result[$count] = $row;
                $count++;
            }
            return $result;            
        }
        ?>
		<section>
			<div class="divInSection">
				
				<form action="handleStudentRegistration.php" method="post" align="center">
					<table align="center;">					
					<tr><td>Year of Joining: </td><td><input type="number" name="year"><td></tr>
                        <tr><td>Semester of Joining: </td>
                            <td><select name="semester">
                              <option value="Spring">Spring</option>
                              <option value="Summer">Summer</option>
                              <option value="Fall">Fall</option>                              
                            </select>
                            </td></tr>
					<tr><td>GPA: </td><td><input type="number" step="any" name="gpa"><td></tr>
					<tr><td>Degree Status: </td><td><select name="degreeStatus">
                              <option value="Completed">Completed</option>
                              <option value="Pursuing">Pursuing</option>
                              <option value="Yet To Start">Yet To Start</option>                              
                            </select><td></tr>
					<tr><td>Degree Type:</td><td><input type="text" name="degreeType"><td></tr>
					<tr><td>Jobs/Internships: </td><td><input type="text" name="jobs"><td></tr>
                    
					<tr><td>Course1:<select name = 'Course1' ><option selected="selected">Select a Course</option>
                        <?PHP                           
                            $CourseList =  getCourseList(); 
                            $count = count($CourseList) - 1;
                            while($count >= 0)
                            {
                                echo '<option value="'.$CourseList[$count][0].'">'.$CourseList[$count][1].'</option>';
                                $count--;

                            }                      
                        
                        ?>
                        </select></td>
                        <td>Course2:<select name = 'Course2'><option selected="selected">Select a Course</option>
                        <?PHP                           
                            $CourseList =  getCourseList(); 
                            $count = count($CourseList) - 1;
                            while($count >= 0)
                            {
                                echo '<option value="'.$CourseList[$count][0].'">'.$CourseList[$count][1].'</option>';
                                $count--;

                            }                      
                        
                        ?>
                        </select></td>
                        <td>Course3:<select name = 'Course3'><option selected="selected">Select a Course</option>
                        <?PHP                           
                            $CourseList =  getCourseList(); 
                            $count = count($CourseList) - 1;
                            while($count >= 0)
                            {
                                echo '<option value="'.$CourseList[$count][0].'">'.$CourseList[$count][1].'</option>';
                                $count--;

                            }                      
                        
                        ?>
                        </select></td>
                        </tr>
					
					<tr>
                    <td>Show GPA:</td>
                    <td><input type="radio" name="showGpa" value="y">Yes</td>
                    <td><input type="radio" name="showGpa" value="n">No</td>
                    </tr>
					<tr>
                    <td>Show Group/Club:</td>
                    <td><input type="radio" name="showGroupClub" Value="y">Yes</td>
                    <td><input type="radio" name="showGroupClub" value="n">No</td></tr>
					<tr>
                    <td>Show Course Interest Group:</td>
                    <td><input type="radio" name="showCourseInterestGroup" value="y">Yes</td>
                    <td><input type="radio" name="showCourseInterestGroup" value="n">No</td>
                    </tr>
					<tr><td colspan="2"><input type="submit" value="Register"  name="submit"></td></tr>
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
    
    


