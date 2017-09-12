<?php
// Start the session
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
		<?php include "navbar.html"?>
	
		<section>
			<div class="divInSection">                
				<form action="EditCIGComments.php" method="POST">                      
                    
                    <?php
                    include 'dbconnect.php';                    
                    $query = "SELECT c.COMMENTID, c.COMMENTEDBY, c.TOPICID,c1.forumId,c.comments, c.DATEANDTIME FROM comments c
                                            INNER JOIN topic t
                                            ON c.TOPICID = t.TOPICID
                                            INNER JOIN COURSEINTERESTGROUP_HAS c1
                                            ON c1.FORUMID = t.FORUMID
                                            INNER JOIN COURSEINTERESTGROUP c2
                                            ON c1.GROUPID = c2.GROUPID";
                    
                    $query = $query ." WHERE 1=1";

                    if (!empty($_POST['courseInterestGroupListddl']))
                    {
                        
                        $groupId = $_POST['courseInterestGroupListddl'];
                        
                        $query = $query . "  AND c1.groupId = $groupId";
                        
                    }
                    if (!empty($_POST['UserIdIn']))
                    {
                        $commentedBy = $_POST['UserIdIn'];
                        $query = $query .  "  AND c.commentedBy = $commentedBy";
                    }   
                    if (!empty($_POST['TopicIdIn']))
                    {                   
                        $TopicId = $_POST['TopicIdIn'];
                        $query = $query .  " AND c.TopicId = $TopicId";
                    }
                    if (!empty($_POST['ForumIdIn']))
                    {
                        $ForumId = $_POST['ForumIdIn'];
                        $query = $query .  " AND c1.forumId = $ForumId";
                    }

                    
                    $sql = oci_parse($conn, $query);                  

                    if (!$sql) {
                      $e = oci_error();
                      echo $e; 	
                    } 
                    $result = oci_execute($sql);
                    if (!$result) {
                      $e = oci_error();
                      echo $e; 	
                    } 

                    echo "<table border='1'>\n";
                    echo "<tr>";
                    echo "<th>CommentId</th>";
                    echo "<th>CommentedBy</th>";
                    echo "<th>TopicId</th>";
                    echo "<th>ForumId</th>";
                    echo "<th>Comments</th>";
                    echo "<th>Date And Time</th>";
                    echo "<th>Edit Comments</th>";
                    //echo "<th>Delete Comments</th>";

                    echo "</tr>";
                   
                    while ($row = oci_fetch_array($sql,OCI_BOTH)) { 
                        
                        $CommentId = $row[0];                        
                        $CommentedBy = $row[1];
                        $TopicID = $row[2];
                        $ForumId = $row[3];
                        $Comments = $row[4];
                        $DateAndTime = $row[5];
                        
                        echo "<tr>\n";
                        echo "    <td>".($CommentId !== null ? htmlentities($CommentId, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".($CommentedBy !== null ? htmlentities($CommentedBy, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".($TopicID !== null ? htmlentities($TopicID, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".($ForumId !== null ? htmlentities($ForumId, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".($Comments !== null ? htmlentities($Comments, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".($DateAndTime !== null ? htmlentities($DateAndTime, ENT_QUOTES) : "&nbsp;"). "</td>\n";
                        echo "    <td>".'<a href= "EditCIGComments.php?CID=' . $CommentId . '&comment=' . $Comments .'">'."Edit".'</a>'. "</td>\n";
                       /* echo "    <td>".'<a href= "DeleteCIGComments.php?CID=' . $CommentId . '&comment=' . $Comments .'">'."Delete".'</a>'. "</td>\n";*/
                        echo "</tr>\n";
                        
                    }                  
                    
                    print "</table>\n";                 
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