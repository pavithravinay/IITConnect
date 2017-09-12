
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Course Registration</title>
		<center><code></code></center>
		<!--<style>
				header {
			background-color:black;
			color:white;
			text-align:center;
			padding:25px; 
		}
		nav.firstNav {
			line-height:30px;
			background-color:LightGray;
			height:450px;
			width:250px;
			float:left;
			padding:10px; 
		}
		
		nav.secondNav {
			line-height:30px;
			background-color:LightGray;
			height:450px;
			width:250px;
			float:left;
			padding:10px; 
		}
		
		section {
			height:450px;
			width:687px;
			float:left;
			padding:10px; 
			background-color:grey;
		}
		
		footer {
			background-color:black;
			color:white;
			clear:both;
			text-align:center;
			padding:25px; 
		}
		div.divInSection {
			background-color:Silver;
			color:white;
			clear:both;
			text-align:center;
			padding:132px; 
		}
		</style>-->
		
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
                
                <form action="CourseEnrollment.php"  method="post">
                    <label>Select a course below to register. </label><br>
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
                    &nbsp&nbsp&nbsp&nbsp&nbsp
                    
                    <input type="submit" value="Register" name="submit"><br>
                    <br>
                    <br>
                    <br>
                </form>
				
<!--
				<form action="">
					Registered Courses:
                    <div>
                     hyperlink subject names here 
                    <input type="button" value="Course">
                    </div>
                    <input type="submit" value="Refresh Registered Course List">
				</form>
-->
				
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
