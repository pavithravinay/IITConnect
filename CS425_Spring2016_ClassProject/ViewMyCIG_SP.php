<?php
// Start the session
session_start();
?>

<?php
include 'dbconnect.php';
 $studentId = $_SESSION['myCig'];

$sql = oci_parse($conn, "SELECT j.groupID, c.name
FROM JOINSCIG j
INNER JOIN COURSEINTERESTGROUP c
ON j.GROUPID = c.GROUPID
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
echo "<th>GroupID</th>";
echo "<th>GroupName</th>";

while ($row = oci_fetch_array($sql,OCI_BOTH)) {
    $CIGId = $row[0];
    $CIGName = $row[1];
    echo "<tr>\n";
    echo "    <td>".($CIGId !== null ? htmlentities($CIGId, ENT_QUOTES) : "&nbsp;"). "</td>\n";         
    echo "    <td>".'<a href= "CIGLogin.php?groupId=' . $CIGId .'">'.($CIGName !== null ? htmlentities($CIGName, ENT_QUOTES) : "&nbsp;").'</a>'. "</td>\n";
    
    echo "</tr>\n";
}

echo "</table>\n";
//echo 'UserName'.'<input type=" '.text'".value="'username'".name="'UserName'">';
oci_free_statement($sql);
echo "<a href = 'Profile.php'>Go to homepage.</a>";
?>