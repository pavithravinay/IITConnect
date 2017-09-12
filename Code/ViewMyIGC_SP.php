<?php
// Start the session
session_start();
?>

<?php
include 'dbconnect.php';
 $studentId = $_SESSION['myIgc'];

$sql = oci_parse($conn, "SELECT j.groupclubID, i.name, i.type
FROM JOINS j
INNER JOIN INTERESTGROUP_Club i
ON j.GROUPCLUBID = i.GROUPCLUBID
WHERE j.MEMBERID = $studentId AND j.APPROVALSTATUS='Y'");
	
if (!$sql) {
  $e = oci_error();
  echo $e; 	
} //if (!$stid) {
$result = oci_execute($sql);
if (!$result) {
  $e = oci_error();
  echo $e; 	
} 

print "<table border='1'>\n";
echo "<th>GroupClubID</th>";
echo "<th>GroupName</th>";
echo "<th>Type</th>";

while ($row = oci_fetch_array($sql,OCI_BOTH)) {
    $IGCId = $row[0];
    $IGCName = $row[1];
    $type = $row[2];
    echo "<tr>\n";
    echo "    <td>".($IGCId !== null ? htmlentities($IGCId, ENT_QUOTES) : "&nbsp;"). "</td>\n";          
    echo "    <td>".'<a href= "IGCLogin.php?groupClubId=' . $IGCId .'">'.($IGCName !== null ? htmlentities($IGCName, ENT_QUOTES) : "&nbsp;").'</a>'. "</td>\n";
    echo "    <td>".($type !== null ? htmlentities($type, ENT_QUOTES) : "&nbsp;"). "</td>\n";   
    
    echo "</tr>\n";
}

echo "</table>\n";
//echo 'UserName'.'<input type=" '.text'".value="'username'".name="'UserName'">';
oci_free_statement($sql);
?>
<!--<a href= "searchpeople_sp.php">Go to homepage.</a>-->