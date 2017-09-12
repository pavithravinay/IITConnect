<?php
// Start the session
session_start();
$moderatorId = $_SESSION['UserId'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html"?>
		
	
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				<!--Display list of Course Interest groups for the user to select-->
				<form action="ViewIGCComments.php"  method="post">
                    <table>
                        <tr>
                            <td>Select an Interest Group/Club: </td>
                            <td>Commented By: <input type="text" name="UserIdIn" value=""></td>
                            <td>Topic Id: <input type="text" name="TopicIdIn" value=""></td>
                            <td>Forum Id: <input type="text" name="ForumIdIn" value=""></td>
                            <td><input type="submit" value="View Comments" name="submit"></td>
                            
                        </tr>
                    </table>                  
                    
            
                    <?php
                        include 'dbconnect.php';
                        $sql = oci_parse($conn, "SELECT i.groupClubId,i.name 
                                                FROM moderatesIGC m
                                                INNER JOIN INTERESTGROUP_CLUB i 
                                                ON m.GROUPCLUBID = i.GROUPCLUBID AND m.modID = $moderatorId ");

                        if (!$sql) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$sql) {
                        $result = oci_execute($sql);
                        if (!$result) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        echo'<select name="InterestGroupClubListddl">';
                        

                        while ($output = oci_fetch_array($sql,OCI_BOTH))
                        {
                            $IGCId = $output[0];
                            $IGCName = $output[1];
                                                           
                            echo '<option value="' . ($IGCId !== null ? htmlentities($IGCId,ENT_QUOTES):"&nbsp") . '">'
                                . ($IGCName !== null ? htmlentities($IGCName,ENT_QUOTES):"&nbsp") . 
                                '</option>';                                                      

                        }
                        echo"</select>";
                        oci_free_statement($sql); 
                    
                      ?>
                     <br>
                    <a href="Profile.php">Go to home page</a>
                    
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