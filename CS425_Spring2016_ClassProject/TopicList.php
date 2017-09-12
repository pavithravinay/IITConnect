<?php
session_start();
$userID = $_SESSION['UserId'];
$_SESSION['UserId'] = $userID;
$forumId = $_SESSION['forumId'];
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
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="Comments.php" method="post">
					Select a Topic Below.
                    
                    <?php
                    include 'dbconnect.php';
                    //$ForumID = $_POST['forumId'];
                    
                    $selectTopicList = oci_parse($conn, "select t.TOPICNAME from topic t
                                                        INNER JOIN DISCUSSIONFORUM d
                                                        ON t.FORUMID = d.FORUMID
                                                        INNER JOIN COURSEINTERESTGROUP_HAS ch
                                                        ON d.FORUMID = ch.FORUMID
                                                        INNER JOIN COURSEINTERESTGROUP c
                                                        ON ch.GROUPID = c.GROUPID
                                                        WHERE d.FORUMID = $forumId ");
                    if (!$selectTopicList) {
                          $e = oci_error();
                          echo $e; 	
                        } 
                            
                        $topicListResult = oci_execute($selectTopicList);
                        if (!$topicListResult) {
                          $e = oci_error();
                          echo $e; 	
                        } 
                     echo'<select name="topicListddl">';
                        echo'<option selected="selected">select a topic</option>';

                        while ($topicList = oci_fetch_array($selectTopicList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {

                            foreach($topicList as $topicId)
                            {
                                //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                                echo '<option value="' . ($topicId !== null ? htmlentities($topicId,ENT_QUOTES):"&nbsp") . '">'
                                    . ($topicId !== null ? htmlentities($topicId,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                        echo"</select>";
                        oci_free_statement($selectTopicList);  
                    
                    
                    ?>
                    <input type="submit" value="Go to Topic Comments">
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