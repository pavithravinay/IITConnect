
<?php
// Start the session
session_start();
$userId = $_SESSION['UserId'];


if(isset($_GET['groupClubId']))
{
    $IGCId = $_GET['groupClubId'];
}
else
{
    $IGCId = $_SESSION['GroupClubId'];
}

$_SESSION['GroupClubId']=$IGCId;
?>
<!DOCTYPE html>
<html>
    <head>
        <body>
            <form action="IGCDiscussionForums.php" method="post">
                  UserName:<br>
                  <input type="text"  name="usernameIn" value=""><br>
                  Password:<br>
                  <input type="password" name="passwordIn" value=""><br><br>
                  <input type="submit" value="Submit">
            </form>      
        </body>  
    </head>
</html>