<?php
// Start the session
session_start();
$userId = $_SESSION['userId'];

?>

<!DOCTYPE html>
<html>
    <head>
        <body>
            <form action='AssignTA.php' method="post"> 
                <?php                    
                        $courseId = $_GET['courseId'];                     
                       
                   
                ?> 
            </form>      
        </body>  
    </head>
</html>