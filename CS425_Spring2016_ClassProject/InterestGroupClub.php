<?php
    session_start();
    $userId = $_SESSION['UserId'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
<!--		<link href="/CS425ProjectSpring2016/styles/css/site.css" rel="stylesheet" type="text/css">		-->
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
                <!--Display list of Interest group/club for the user to select-->
				<form action="ShowRegistrationMessage.php"  method="post">
                    Select an Interest Group OR Club below: <br>            
                    <?php
                        include 'dbconnect.php';
                        $sql = oci_parse($conn, "SELECT groupClubId, name FROM INTERESTGROUP_CLUB");

                        if (!$sql) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$selectInterestGroupClubList) {
                        $sqlResult = oci_execute($sql);
                        if (!$sqlResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        echo'<select name="IGCListddl">';
                        echo'<option selected="selected">select a Group or Club</option>';

                        while ($sqlResult = oci_fetch_array($sql,OCI_BOTH))
                        {
                            $IGCName = $sqlResult[1];
                            $IGCId = $sqlResult[0];
                                                           
                            echo '<option value="' . ($IGCId !== null ? htmlentities($IGCId,ENT_QUOTES):"&nbsp") . '">'
                                . ($IGCName !== null ? htmlentities($IGCName,ENT_QUOTES):"&nbsp") . 
                                '</option>';                                                      

                        }
                   
                        echo"</select>";
                        oci_free_statement($sql); 
                    //Todo: Remove hardcoding of the UserId
                    //$userId = $_POST['userId'];
                        //$userId=1;
                        $type = "IGC";
                      ?>
                    <input type="hidden" name="userId" value="<?php echo $userId;?>" />    
                    <input type="hidden" name="groupType" value="<?php echo $type;?>" />  
                    <input type="submit" value="Register" name="submit"><br><br>
                    <a href = "Profile.php">Go to homepage.</a>
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