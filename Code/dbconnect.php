<?php
//include ('OCI.inc');
    
    
//Connect to the DB

$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = fourier.cs.iit.edu)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;

$conn = OCILogon("pvinay","Donotreveal",$db);

if (!$conn) {
  $e = oci_error();
  echo "$e"; 	
} 
/*else{
    echo "Hello";
}*/
//if (!$conn) {

?>