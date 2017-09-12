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
				<form action="AssignModerator3.php" method="post">
                    Select a TA below.<br>
                   
                                                                   
                        
                    <?php
                        include 'dbconnect.php';
                        $check = array_key_exists('courseListddl', $_POST)?"":"No";
                    echo $check;
                        $COURSEID = $_POST['courseListddl']; //echo $COURSEID;
                        $groupId = $_POST['groupListDdl']; //echo $groupId;
                   // echo $COURSEID;
                        $taQuery = "SELECT TAID FROM ASSISTS WHERE COURSEID = $COURSEID AND TAID NOT IN (SELECT MODID FROM MODERATESCIG WHERE GROUPID = $groupId)";   
                        $selectTAList = oci_parse($conn, $taQuery);

                        if (!$selectTAList) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$selectCourseList) {
                        
                        if(!$selectTAList){
                            echo "Something Wrong.";
                        }
                    else
                    {
                        //echo "Right.";
                    }
                        
                        $taListResult = oci_execute($selectTAList);
                        if (!$taListResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 
                             
                        echo'<select name="taListddl">';
                        echo'<option selected="selected">select a TA</option>';

                        while ($taList = oci_fetch_array($selectTAList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {

                            foreach($taList as $taId)
                            {
                                //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                                echo '<option value="' . ($taId !== null ? htmlentities($taId,ENT_QUOTES):"&nbsp") . '">'
                                    . ($taId !== null ? htmlentities($taId,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                        echo"</select>";
                        oci_free_statement($selectTAList);                                
                      ?>
                    <input type="hidden" value="<?php echo $_POST['courseListddl']?>" name="courseId">    
                    <input type="submit" value="Assign As Moderator" name="submit"><br><br>
                    <a href = "WelcomeToBackEnd.php">Go to homepage.</a>
                    
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