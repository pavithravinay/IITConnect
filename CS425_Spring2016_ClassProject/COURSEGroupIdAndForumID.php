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
                    
                    $groupId = $_SESSION['GID'];
                    $queryCIG = "SELECT ch.GROUPID,ch.FORUMID,d.FORUMNAME 
                                FROM COURSEINTERESTGROUP_HAS ch
                                INNER JOIN DiscussionForum d
                                ON ch.FORUMID = d.FORUMID
                                WHERE groupId = '$groupId' ";
                    //echo $queryCIG;
                    $CIG = oci_parse($conn, $queryCIG);
                    $CIGResult = oci_execute($CIG);
                    $CIGResultRow = oci_fetch_array($CIG,OCI_BOTH);
                    
                    if(!$CIG){
                        echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                      if(!$CIGResult){
                         echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                      if(!$CIGResultRow){
                          echo "Wrong.";
                    }else
                    {
                          //echo "Right.";
                    }
                    
                    $resultArr = array();
                    $ctr = 0;
                    
                     while($row = oci_fetch_array($CIG,OCI_BOTH)){
                        $resultArr[$ctr] = array($row[0],$row[1],$row[2]);
                        $ctr++;
                    }
                    
                    $secondExecution = oci_execute($CIG);
                    
                    echo "<section>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Group ID</th><th>Forum ID</th>";
                    echo "<th>Forum Name</th>";
                    echo "</tr>";
                    
                    while ($row = oci_fetch_array($CIG,OCI_BOTH))
                        {

                            //echo $row[0];
                               echo "<tr>";
                               echo "<td>".$row[0]."</td>"; 
                               $forumId = $row[1];
                                $_SESSION['forumId'] = $forumId;
                               echo "<td><a href='DiscussionForum.php?forumId=$forumId'>".$forumId."</a></td>";
                        //echo "    <td>".'<a href= "IGCLogin.php?groupClubId=' . $IGCId .'">'.($IGCName !== null ? //htmlentities($IGCName, ENT_QUOTES) : "&nbsp;").'</a>'. "</td>\n";
                               echo "<td>".$row[2]."</td>"; 
                               echo "</tr>";
                            

                        }
                         echo "</table>";
                    echo "</section>";
                    
                    oci_free_statement($CIG);
                    
                    ?>
                    
                    
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