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
    
   
    $user=$_POST['createdBy'];
    $forumname=$_POST['forumName'];
   
            $SelectForumId = "SELECT max(ForumId) FROM DiscussionForum";    

                $p1 = oci_parse($conn, $SelectForumId);
                $result = oci_execute($p1); 

                while($ForumId = oci_fetch_row($p1))
                {
                    $ForumIdnew = $ForumId[0];
                    if($ForumIdnew >=1)
                    {
                        $newForumId = intval($ForumIdnew) + 1;
                    }
                    else
                    {
                        $newForumId = 1;
                    } 
                }
            $sql1="insert into DISCUSSIONFORUM(ForumID,FORUMNAME,CREATEDBY) "; 
            $sql1.="VALUES ($newForumId,'$forumname',$user)";
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
        $groupClubId = $_SESSION['IGID'];
       $sql2="insert into InterestGroupClub_Has(ForumID,GroupClubId) "; 
            $sql2.="VALUES ($newForumId, $groupClubId)";
                $query2 = oci_parse($conn,$sql2);
            //oci_bind_by_name($query,':forumName',$forumname);
            //oci_bind_by_name($query,':createdBy',$user);
  if (!$query2) {
    $error = oci_error();
    echo $error;  
  }
    $run2 = oci_execute($query2);
  if (!$run2) {
    $error = oci_error();
    echo $error;  
  }
        echo "<section>";
       echo "You have successfully created the Discussion Forum";
       echo "</section>";
       
    echo "<br>";
    
        }
        
    
  
    
//oci_free_statement($query);
oci_close($conn);
   

?>
                    <section><a href="Profile.php">Go to home page</a></section>
                    
            </FORM>
        
        </BODY>
    </HEAD>
</HTML>


