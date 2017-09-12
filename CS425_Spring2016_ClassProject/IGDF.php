<?php

session_start();
$userId = $_SESSION['UserId'];
$groupClubId = $_SESSION['IGID'];
$_SESSION['IGID'] = $groupClubId;

?>
  


<html>
    <body>
        <?php include "navbar.html"?>
        <section>
       
    <form name="OpenDiscussionForum" action="IGDF1.php" method=POST>
    
    
    ForumName:<input type="text" name=forumName value=""><br><br>
    CreatedBy:<input type="text" name=createdBy value="<?php echo $userId?>"><br><br>
        <input type="submit" value="create">  
    
    </form>
     </section>
        
    </body></html>
  
    