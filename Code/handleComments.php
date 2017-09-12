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
		<?php include "navbar.html" ?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="">
					<?php
                    include 'dbconnect.php';
                    
                    //Update User ID with $_POST['']
                    $date = date('m-d-Y H:i:s');
                    $date1 = new DateTime();
                    
                    $commentedBy = intval($_POST['UserId']);
                    $topicId = intval(isset($_POST['topicId'])?$_POST['topicId']:'');
                    $comment = strval(isset($_POST['comment'])?$_POST['comment']:'');
                    
                    $commentNumber = "SELECT MAX(COMMENTID) FROM COMMENTS";
                    $commentNum = oci_parse($conn, $commentNumber);
                    $commentNumResult = oci_execute($commentNum);
                    $commentNumResultRow = oci_fetch_array($commentNum, OCI_BOTH);
                    $newRow = $commentNumResultRow[0] + 1;
                    
                    $insertCommentQuery = "INSERT INTO COMMENTS(COMMENTID, COMMENTEDBY, TOPICID, COMMENTS, DATEANDTIME) VALUES ($newRow,$commentedBy,$topicId,'$comment',current_timestamp)";
        //echo $insertCommentQuery;
       
                    
                    $commentQuery = oci_parse($conn,$insertCommentQuery);
                    $commentQueryResult = oci_execute($commentQuery);
                    
                    //$query = ;
                    ?>
                    
				</form>
				<a href="Profile.php">Successfully Commented. Go to Homepage.</a>
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