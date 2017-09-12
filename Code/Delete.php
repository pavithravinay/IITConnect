<?php

include 'dbconnect.php';



$sql="SELECT * FROM user_tables";
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
  <html><head/>
 <body>
  <form action=Delete1.php method=POST>
  Select a Table:<br/>
  <select name=tableName size=10>";
While ($row = oci_fetch_array($query))  {
  $display .= "<option value='$row[TABLE_NAME]'>$row[TABLE_NAME]</option>";
}
$display .= "<select><br><br>

  <br><br>
  <input type=submit>
  
  </form>
  </body></html>";

oci_free_statement($query);
oci_close($conn);

echo $display;
?>