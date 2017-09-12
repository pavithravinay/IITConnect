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
  <form action=Insert1.php method=POST>
  Tables in Database:<br>
  <select id=tableName name=tableName size=20>";
While ($row = oci_fetch_array($query))  {
  $display .= "<option value='$row[TABLE_NAME]'>$row[TABLE_NAME]</option>";
}
$display .= "<select><br><br>
 
   Row to Insert:<br><br>
  <input type=textarea name=values size=75><br><br>
  <input type=submit>
  
  </form>
  </body></html>";

oci_free_statement($query);
oci_close($conn);

echo $display;
?>