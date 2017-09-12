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
				<form action="ViewCIGComments.php"  method="post">
                    <table>
                        <tr>
                            <td>Select a Course Interest Group: </td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        </tr>
                    </table>
                            
            
                    <?php
                        include 'dbconnect.php';
                        $sql = oci_parse($conn, "SELECT c.groupId,c.name 
                                                FROM moderatesCIG m
                                                INNER JOIN COURSEINTERESTGROUP c 
                                                ON m.GROUPID = c.GROUPID AND m.modID = $moderatorId ");

                        if (!$sql) {
                          $e = oci_error();
                          echo $e; 	
                        } //if (!$sql) {
                        $result = oci_execute($sql);
                        if (!$result) {
                          $e = oci_error();
                          echo $e; 	
                        } 

                        echo'<select name="courseInterestGroupListddl">';
                        

                        while ($output = oci_fetch_array($sql,OCI_BOTH))
                        {
                            $CIGId = $output[0];
                            $CIGName = $output[1];
                                                           
                            echo '<option value="' . ($CIGId !== null ? htmlentities($CIGId,ENT_QUOTES):"&nbsp") . '">'
                                . ($CIGName !== null ? htmlentities($CIGName,ENT_QUOTES):"&nbsp") . 
                                '</option>';                                                      

                        }
                        echo"</select>";
                        oci_free_statement($sql); 
                    
                      ?>
                    <table >    
                         <tr>
                        <td>&nbsp;</td>
                        </tr>
                    <tr><td>Commented By: </td><td><input type="text" name="UserIdIn" value=""></td></tr>
                        <tr><td>&nbsp;</td></tr>
                                <tr><td>Topic Id: </td><td><input type="text" name="TopicIdIn" value=""></td></tr>
                        <tr><td>&nbsp;</td></tr>
                                <tr><td>Forum Id: </td><td><input type="text" name="ForumIdIn" value=""></td></tr>
                        <tr><td>&nbsp;</td></tr>
                                <tr><td><input type="submit" value="View Comments" name="submit"></td></tr>
                            
                    </table>                  
                    
                    
<a href="Profile.php">Go to Home Page</a>
                    
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