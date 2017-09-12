<?php
include 'dbconnect.php';


$sql = "SELECT COLUMN_NAME FROM user_tab_columns WHERE TABLE_NAME='$_POST[tableName]'";
$query = oci_parse($conn, $sql);
if (!$query) {
  $error = oci_error();
  echo $error;  
}
$run = oci_execute($query);
if (!$run) {
  $error = oci_error();
  echo $error;  
} else { $row = oci_fetch_array($query); }


 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if ($_POST['tableName'])  {
    $sql = "DELETE FROM $_POST[tableName] WHERE $row[0] = $_POST[rowID]"; 
  } 
  $query = oci_parse($conn, $sql);
    //echo $sql;
  if (!$query) {
    $error = oci_error();
    echo "$error";  
  }
  $run = oci_execute($query);
  if (!$run) {
    $e = oci_error();
    echo "$error";  
  } else { 
      echo "<br>";
      echo "Delete Seccessful";
      echo "<br>";
      echo "<a href = 'WelcomeToBackEnd.php'>Go to home page.>";
  }

}

oci_free_statement($query);
oci_close($conn);

?>