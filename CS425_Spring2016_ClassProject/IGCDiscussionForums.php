

<?php
    // Start the session
    session_start();
    $userId = $_SESSION['UserId'];
    $userName = $_POST['usernameIn'];
    $password = $_POST['passwordIn'];
    include "navbar.html";

    if(empty($userName) || empty($password))
    {        
         DisplayErrorMessage();     
    }
    else
    {
        $numofRows = verifyCredentials($userName, $password);
        
        if($numofRows==0)
        {
            DisplayErrorMessage();
        }                        
        else
        {
            echo "<section>";
            echo '<h2><a href="IGDF.php">Create Discussion Forum</a></h2>';
            echo '<h2><a href="InterestGroupClubGroupIdAndForumId.php">View Discussion Forum</a></h2>';
            echo "</section>";
        }
    }
    
    

    function verifyCredentials($userName,$password )
    {
                
        include 'dbconnect.php';
        $UserId = intval($_SESSION['UserId']);
        $GroupClubId = intval($_SESSION["GroupClubId"]);  
        
        $_SESSION['UserId'] = $UserId;
               
        $sql = oci_parse($conn, "SELECT username, password FROM joins
                where memberId=$UserId and GROUPCLUBID=$GroupClubId and username='$userName' and password='$password'");                                     
        
                if (!$sql) {
                  $e = oci_error();
                  echo $e; 	
                } //if (!$stid) {
                $result = oci_execute($sql);
                if (!$result) {
                  $e = oci_error();
                  echo $e; 	
                } 
        
                $results=array();
                $numrows = oci_fetch_all($sql, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                $_SESSION['IGID'] =  $GroupClubId;
                //echo $_SESSION['IGID'];
        
                return $numrows;
        
    }

    function DisplayErrorMessage()
    {           
        echo "Invalid Username/Passord. Please try again.";
        echo "<a href=IGCLogin.php>Go Back</a>";      
    }

    

?>

