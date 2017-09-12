
<?php
// Start the session
session_start();
$userId = $_SESSION['UserId'];


if(isset($_GET['groupId']))
{
    $CIGId = $_GET['groupId'];
}
else
{
    $CIGId = $_SESSION['GroupId'];
}

$_SESSION['GroupId']=$CIGId;
?>
<!DOCTYPE html>
<html>
    <head>
        <body>
            <form action='CIGDiscussionForums.php' method="post">
                  UserName:<br>
                  <input type="text"  name="usernameIn" value=""><br>
                  Password:<br>
                  <input type="password" name="passwordIn" value=""><br><br>
                  <input type="submit" value="Submit">
                
            </form>      
        </body>  
    </head>
</html>