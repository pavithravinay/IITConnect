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
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="AssignModerator2.php" method="post">
					Select a Group.<br>
                    
                    <?php
                    include 'dbconnect.php';
                    error_reporting(E_ALL & ~E_NOTICE);
                    
                    $courseId = $_POST['courseListddl'];
                    //echo $courseId;
                    
                   $selectGroupList = oci_parse($conn, "SELECT GROUPID FROM COURSE_HAS WHERE COURSEID = $courseId");
                    
                    if(!$selectGroupList){
                        $e = oci_error();
                        echo $e;
                    }
                    
                    $groupListResult = oci_execute($selectGroupList);
                    if(!$groupListResult){
                        $e = oci_error();
                        echo $e;
                    }
                    
                    echo'<select name="groupListDdl">';
                    
                        echo'<option selected="selected">select a group</option>';

                        while ($groupList = oci_fetch_array($selectGroupList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {

                            foreach($groupList as $groupId)
                            {
                                //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                                echo '<option value="' . ($groupId !== null ? htmlentities($groupId,ENT_QUOTES):"&nbsp") . '">'
                                    . ($groupId !== null ? htmlentities($groupId,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                        echo"</select>";
                        oci_free_statement($selectGroupList);     
                    
                    
                    ?>
                    
                    <input type="hidden"  value="<?php echo $courseId; ?>" name="courseListddl">
                    <input type="submit" value="Select" name="submit"><br><br>
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