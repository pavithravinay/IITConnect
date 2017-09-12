<?php
// Start the session
session_start();
?>
<html>
    <head>
        <body>
            
            <?php
            include "navbar.html";         
            $_SESSION['CID'] = $_GET['CID'];
                    $comment = $_GET['comment'];
                ?>
            <section>
            <table >
                <tr>
                    
            
                    <form action="UpdateIGCComments.php" method="post">  
                  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment ?></textarea><br><br>               
                  <input type="submit" value="Update">               
            </form> 
                    
                    
            <form action="DeleteIGCComments.php" method="post">  
<!--                  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment ?></textarea><br><br>               -->
                  <input type="submit" value="Delete">               
            </form> 
                </tr>
                    
             </table>
            </section>
        </body>  
    </head>
</html>