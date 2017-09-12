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
				
				<form action="AssignModeratorPOINT5.php" method="post">
                    Select a course below.<br>
                        
                    <?php
                        include 'dbconnect.php';
                        $selectCourseList = oci_parse($conn, "SELECT id FROM course");

                        if (!$selectCourseList) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$selectCourseList) {
                            
                        $courseListResult = oci_execute($selectCourseList);
                        if (!$courseListResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 
                             
                        echo'<select name="courseListddl">';
                        echo'<option selected="selected">select a course</option>';

                        while ($courseList = oci_fetch_array($selectCourseList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {

                            foreach($courseList as $courseId)
                            {
                                //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                                echo '<option value="' . ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") . '">'
                                    . ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                        echo"</select>";
                        oci_free_statement($selectCourseList);                                
                      ?>
                        
                    <input type="submit" value="Select" name="submit">
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