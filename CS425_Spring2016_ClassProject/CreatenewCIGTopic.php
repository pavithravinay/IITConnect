<?php 
session_start();

?>
<!DOCTYPE html>
<HTML>
    <HEAD>
        <BODY>
                <FORM action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
                    <?php
    include 'dbconnect.php';
    include "navbar.html";
 
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
   
    //$user=$_POST['createdBy'];
    //$forumname=$_POST['forumName'];
       $topicName = $_POST['topicName'];
       $forumId = $_SESSION['forumId'];
       //echo $forumId;
    
   
            $SelectTopicId = "SELECT max(TopicId) FROM Topic";    

                $p1 = oci_parse($conn, $SelectTopicId);
                $result = oci_execute($p1); 

                while($TopicId = oci_fetch_row($p1))
                {
                    $TopicIdnew = $TopicId[0];
                    if($TopicIdnew >=1)
                    {
                        $newTopicId = intval($TopicIdnew) + 1;
                    }
                    else
                    {
                        $newTopicId = 1;
                    } 
                }
            $sql1="insert into Topic(TopicId,TopicName,ForumId) "; 
            $sql1.="VALUES ($newTopicId,'$topicName',$forumId)";
                $query1 = oci_parse($conn,$sql1);
            //oci_bind_by_name($query,':forumName',$forumname);
            //oci_bind_by_name($query,':createdBy',$user);
  if (!$query1) {
    $error = oci_error();
    echo $error;  
  }
    $run1 = oci_execute($query1);
  if (!$run1) {
    $error = oci_error();
    echo $error;  
  }
      
       
        echo "<section>";
       echo "You have successfully added a new topic.";     
        echo "<br>";
       echo "</section>";
    
        }
        
    
  
    
//oci_free_statement($query);
oci_close($conn);
   

?>
                    <section><a href="Profile.php">Go to home page</a></section>
                    
            </FORM>
        
        </BODY>
    </HEAD>
</HTML>


