<?php

include 'dbconnect.php';



$sql="SELECT * FROM USER_TABLES";
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
$display = "
  <html>
  
  <body>
  <form action=UpdateData1.php method=POST>
  Table to Update:<br>
  <select id=tableName name=tableName size=10>";
While ($row = oci_fetch_array($query))  {
  $display .= "<option value='$row[TABLE_NAME]'>$row[TABLE_NAME]</option>";
}
$display .= "</select><br><br>
  
  
 
 
  <input type=submit>
  <br><br>
  </form>
  </body></html>";

oci_free_statement($query);
oci_close($conn);

echo $display;
?>