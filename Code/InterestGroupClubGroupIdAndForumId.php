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
		<header>
		
		</header>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="">
<!--					List of Group IDs and Forum IDs-->
                    
                    <?php
                    include 'dbconnect.php';
                    include "navbar.html";
                    
                    $userID = $_SESSION['UserId'];
                    $_SESSION['UserId'] = $userID;
                    
                    $groupClubId = $_SESSION['IGID'];
                    //echo $groupClubId;
                    $queryIGC = "SELECT i.GROUPCLUBID,i.FORUMID,d.FORUMNAME 
                                FROM InterestGroupClub_Has i
                                INNER JOIN DiscussionForum d
                                ON i.FORUMID = d.FORUMID
                                WHERE groupClubId = '$groupClubId' ";
                    //echo $queryCIG;
                    $IGC = oci_parse($conn, $queryIGC);
                    $IGCResult = oci_execute($IGC);
                    $IGCResultRow = oci_fetch_array($IGC,OCI_BOTH);
                    
                    if(!$IGC){
                        //echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                      if(!$IGCResult){
                         //echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                      if(!$IGCResultRow){
                          //echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                    $resultArr = array();
                    $ctr = 0;
                    
                     while($row = oci_fetch_array($IGC,OCI_BOTH)){
                        $resultArr[$ctr] = array($row[0],$row[1],$row[2]);
                        $ctr++;
                    }
                    
                    $secondExecution = oci_execute($IGC);
                    
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Group Club ID</th><th>Forum ID</th>";
                    echo "<th>Forum Name</th>";
                    echo "</tr>";
                    
                    while ($row = oci_fetch_array($IGC,OCI_BOTH))
                        {

                            //echo $row[0];
                               echo "<tr>";
                               echo "<td>".$row[0]."</td>"; 
                               $forumId = $row[1];
                               $_SESSION['forumId'] = $forumId;
                               echo "<td><a href='DiscussionForum2.php?forumId=$forumId'>".$forumId."</a></td>";
                               echo "<td>".$row[2]."</td>"; 
                               echo "</tr>";
                            

                        }
                         echo "</table>";
                    
                    oci_free_statement($IGC);
                    
                    ?>
                    
                <br> <a href = "Profile.php">Go to homepage.</a>   
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