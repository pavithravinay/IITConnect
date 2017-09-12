<?php
session_start();
$userID = $_SESSION['UserId'];
$_SESSION['UserId'] = $userID;
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
				
				<form action="handleComments.php" method="post">
					Topic title: <?php
                    echo $_POST['topicListddl'];
                    $topicName = $_POST['topicListddl'];
                   
                    include 'dbconnect.php';
                    $queryComments = "SELECT COMMENTEDBY, COMMENTS, DATEANDTIME FROM COMMENTS ORDER BY DATEANDTIME";
                    $comments = oci_parse($conn, $queryComments);
                    $commentsResult = oci_execute($comments);
                    $commentsResultRow = oci_fetch_array($comments, OCI_BOTH);
                    
                  //  echo $topicName;
                    
                    $queryTopicId = "SELECT TOPICID FROM TOPIC WHERE TOPICNAME = '$topicName' ";
                    $TopicId = oci_parse($conn,$queryTopicId);
                    $TopicIdResult = oci_execute($TopicId);
                    $TopicIdResultRow = oci_fetch_array($TopicId, OCI_BOTH);
                  //  echo $TopicIdResultRow[0];
                    $topicID = $TopicIdResultRow[0];
                    
                    if(!$TopicIdResultRow){
                        //echo "Something is wrong.";
                    }else{
                       // echo "All OK. Proceed.";
                    }
                    
                    
                    if(!$comments){
                        //echo "Something Wrong.";
                    }else{
                       // echo "All OK. Proceed.";
                    }
                    
                    if(!$commentsResult){
                        //echo "Something Wrong.";
                    }else{
                       // echo "All OK. Proceed.";
                    }
                    
                    if(!$commentsResultRow){
                        //echo "Something Wrong.";
                    }else{
                       // echo "All OK. Proceed.";
                    }
                
                    
                    ?>
                    
                    <br>
                    <input type="hidden" name="UserId" value="<?php echo $userID ?>">
                    <input type="hidden" name="topicId" value="<?php echo $topicID ?>">
                    <textarea name="comment" cols="40" rows="5"></textarea>
                    <input type="submit" value="Comment" name="submitComment">
                    
				</form>
				
                <iframe src="AllComments.php" height="250" width="750">
                
                
                </iframe>
                
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