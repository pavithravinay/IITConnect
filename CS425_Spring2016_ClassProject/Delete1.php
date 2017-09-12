<?php
include 'dbconnect.php';
ini_set('display_errors','off');
global $display;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $sql = "SELECT * FROM $_POST[tableName]";
}
  $query = oci_parse($conn, $sql);
  echo $sql;
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
    <form action=Delete2.php method=POST>
    <input type=hidden name=tableName value='$_POST[tableName]'>
    Select a Row to Delete:<br>
    <select id=rowID name=rowID size=20>";
  if($_POST['tableName']) {  
    While ($row = oci_fetch_array($query,OCI_NUM))  {
      $display .= "<option value='$row[0]'>";
      foreach ($row as $value) { $display .= "-$value-"; }
      $display .= "</option>";
    }
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
