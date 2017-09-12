<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Moderator - Manage my groups/clubs </title>
		<center><code></code></center>
<!--		<link href="/CS425ProjectSpring2016/styles/css/site.css" rel="stylesheet" type="text/css">-->
        <script type="text/javascript" src="/CS425_Spring2016_ClassProject/Styles/js/jquery.js"></script>        
        <script type="text/javascript" src="/CS425_Spring2016_ClassProject/Scripts/moderatorIGC.js"></script>        
		
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
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                    <h2><label id="moderatormessagelbl"></label></h2>
                <?php
                    include 'dbconnect.php';
                    $moderatorID = $_SESSION["UserId"];
                    $sql = oci_parse($conn, "SELECT j.memberID, j.groupClubID, i.NAME, i.TYPE 
                                                FROM joins j
                                                INNER JOIN moderatesIGC m
                                                ON j.GROUPCLUBID = m.GROUPCLUBID 
                                                INNER JOIN INTERESTGROUP_CLUB i
                                                ON j.GROUPCLUBID = i.GROUPCLUBID
                                                WHERE APPROVALSTATUS = 'N' AND m.MODID = $moderatorID");

                    if (!$sql) {
                      $e = oci_error();
                      echo $e; 	
                    } 
                    
                    $sqlresult = oci_execute($sql);
                    if (!$sqlresult) {
                      $e = oci_error();
                      echo $e; 	
                    } 
                    
                    
                    //Store the result into a multi dimensional array;
                    $result=array();
                    $counter=0;
                    while ($row = oci_fetch_array($sql,OCI_BOTH)) {                       
                        $result[$counter]=array($row[0],$row[1],$row[2], $row[3]);
                        $counter++;
                    } 
                    
                    
                    //Save the result to session
                    $_SESSION['result']=$result;
                    
                    $sqlresult = oci_execute($sql);
                    if (!$sqlresult) {
                      $e = oci_error();
                      echo $e; 	
                    } 

                    echo "<table border='1'>\n";
                     echo "<tr>
                            <th>UserId</th>
                            <th>GroupClubId</th> 
                            <th>GroupName</th>
                            <th>Type</th>
                            <th>Approve</th>                            
                            <th>Deny</th>
                          </tr>";
                    
                    $count = 0;
                    while ($row = oci_fetch_array($sql,OCI_BOTH)) {
                       
                        echo "<tr>\n";          
                        echo "    <td>".$row[0]. "</td>\n";
                        echo "    <td>".$row[1]. "</td>\n";
                        echo "    <td>".$row[2]. "</td>\n"; 
                        echo "    <td>".$row[3]. "</td>\n"; 
                        echo '<td><button type="submit" name="approvebtn" id="approve' . $count .'" >Approve</button></td>';
                        echo '<td><button type="submit" name="denybtn" id="deny'  . $count . '">Deny</button></td>';
                        
                        echo "</tr>\n";
                         $count++;
                    }
                    echo "</table>\n";
                    
                    oci_free_statement($sql);
                ?>                                                           
<!--                    Todo: Check what should be the home page.-->
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
