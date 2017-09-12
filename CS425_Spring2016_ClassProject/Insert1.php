<?php
include 'dbconnect.php';
global $display;
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  $sql = "INSERT INTO $_POST[tableName] VALUES($_POST[values])";
  $query = oci_parse($conn,$sql);
  if (!$query) {
    $error = oci_error();
    echo $error;  
  }
    $run = oci_execute($query);
  if (!$run) {
    $error = oci_error();
    echo $error;  
  }
    //echo $sql;
    echo "<br>";
    
    
    
}
  
    ?>
<h3>You have successfully inserted data.</h3>
<a href="WelcomeToBackEnd.php" >To insert more rows, click here</a>