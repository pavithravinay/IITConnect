<?php
session_start();
$userID = $_SESSION['UserId'];
$_SESSION['UserId'] = $userID;

if(isset($_GET['forumId']))
{
    $ForumId = $_GET['forumId'];
    
}
else
{
    $ForumId = $_SESSION['forumId'];
}

$_SESSION['forumId'] = $ForumId;
?>


<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
        <script src="jquery-2.2.3.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#topicName").click(function(){
                $("#topicName").val('');
            });
        });
        
        </script>
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
				
				<form action="CreatenewIGCTopic.php" method="post">
                    <input type="text" name="topicName" id="topicName" value="Enter a Topic Name">
					<input type="submit" name="createNewTopic" value="Create Topic"><br><br>
				</form>
                
                <form action="TopicList2.php" method="post">
                    <input type="submit" name="submit" value="View All Topics">
                    <input type ="hidden" name ="forumId" value = "<?php echo $ForumId; ?>">
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

<?php

//Get Topic Name here
$topicName = isset($_POST['topicName'])?$_POST['topicName']:''; 

//Get Forum ID here from Anshul's page
$forumID = 1;

//Insert Into Table "Topic"

?>