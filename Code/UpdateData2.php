<?php

include 'dbconnect.php';



if (isset ($_POST['colID'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST"){  
  $sql = "UPDATE $_POST[tableName] SET $_POST[colID]='$_POST[newValue]'
    WHERE $_POST[myCol]='$_POST[rowID]'";
}
  $query = oci_parse($conn, $sql);
  if (!$query) {
    $error = oci_error();
    echo "$error";  
  }
    //echo $sql;
  $run = oci_execute($query);
  if (!$run) {
    $error = oci_error();
    echo "$error"; 
      echo "not executed";
  } else {
      echo "<br>";
    echo "Update Successful<br><br>";
    echo "<a href = 'WelcomeToBackEnd.php'>Go to home page.>";
    exit;
  }
}


$sql = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE TABLE_NAME='$_POST[tableName]'";
$query = oci_parse($conn, $sql);
if (!$query) {
  $error = oci_error();
  echo "$error";  
}
//echo "$sql";
$run = oci_execute($query);
if (!$run) {
  $error = oci_error();
  echo "$error";  
} else { $row = oci_fetch_array($query); }

  $display = "
    <html><head/>
    <body>
    <form action=updateData2.php method=POST>
    <input type=hidden name=tableName value='$_POST[tableName]'>
    <input type=hidden name=rowID value='$_POST[rowID]'>
    <input type=hidden name=myCol value='$row[0]'>
    Select a Column to Update:<br>
    <select id=colID name=colID size=10>
    <option  value='$row[0]'>$row[0]</option>";
  While ($row = oci_fetch_array($query)) { $display .= "<option value='$row[0]'>$row[0]</option>"; }
  $display .= "</select><br><br>
    Set Value:<br><input type=text name=newValue><br><br>
    <input type=submit>
    <br><br>
    </form>
    </body></html>";
  echo $display;

 

oci_free_statement($query);
oci_close($conn);

?>
