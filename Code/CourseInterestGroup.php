<?php
    session_start();
    $userId = $_SESSION['UserId'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Register to Course Interest groups </title>
		<center><code></code></center>
<!--		<link href="/CS425ProjectSpring2016/styles/css/site.css" rel="stylesheet" type="text/css">-->
		
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
				<!--Display list of Course Interest groups for the user to select-->
				<form action="ShowRegistrationMessage.php"  method="post">
                    <label>Select a Course Interest Group below to register</label><br>
                    <?php
                        include 'dbconnect.php';
                        $selectCourseInterestGroupList = oci_parse($conn, "SELECT groupId, name FROM courseInterestGroup");

                        if (!$selectCourseInterestGroupList) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$selectCourseInterestGroupList) {
                        $courseInterestGroupResult = oci_execute($selectCourseInterestGroupList);
                        if (!$courseInterestGroupResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        echo'<select name="courseInterestGroupListddl">';
                        echo'<option selected="selected">select a Course Interest Group</option>';

                        while ($courseInterestGroupList = oci_fetch_array($selectCourseInterestGroupList,OCI_BOTH))
                        {
                            $courseInterestGroup = $courseInterestGroupList[1];
                            $courseInterestGroupId = $courseInterestGroupList[0];
                                                           
                            echo '<option value="' . ($courseInterestGroupId !== null ? htmlentities($courseInterestGroupId,ENT_QUOTES):"&nbsp") . '">'
                                . ($courseInterestGroup !== null ? htmlentities($courseInterestGroup,ENT_QUOTES):"&nbsp") . 
                                '</option>';                                                      

                        }
                        echo"</select>";
                        oci_free_statement($selectCourseInterestGroupList); 
                    //Todo: Remove hardcoding of the UserId
                    //$userId = $_POST['userId'];
                        //$userId=1;
                        $type = "CIG";
                      ?>
                    <input type="hidden" name="groupType" value="<?php echo $type;?>" />  
                    <input type="hidden" name="userId" value="<?php echo $userId;?>" />                        
                    <input type="submit" value="Register" name="submit">
                </form>
                <br><br><br>
                <a href="Profile.php">Go to Home Page</a>
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