<?php
include 'dbconnect.php';


$sql = oci_parse($conn, "SELECT u.name , c.NAME AS moderates, 'courseInterestGroup' AS type, T.name AS memberOf FROM moderatesCIG m1
INNER JOIN user_ u
ON m1.MODID = u.USERID
INNER JOIN COURSEINTERESTGROUP c
ON m1.GROUPID = c.GROUPID
LEFT OUTER JOIN 
(SELECT C1.name,J1.groupID, J1.MEMBERID FROM JOINSCIG J1
INNER JOIN COURSEINTERESTGROUP C1
ON J1.GROUPID = C1.GROUPID) T
ON u.USERID = T.MEMBERID

UNION
SELECT u.name , igc.NAME AS moderates, CASE igc.type WHEN 'group' THEN 'group'
ELSE 'club' END AS type, T.name AS memberOf FROM moderatesIGC m1
INNER JOIN user_ u
ON m1.MODID = u.USERID
INNER JOIN INTERESTGROUP_CLUB igc
ON m1.GROUPCLUBID = igc.GROUPCLUBID
LEFT OUTER JOIN 
(SELECT igc1.name,J1.groupClubID, J1.MEMBERID FROM JOINS J1
INNER JOIN INTERESTGROUP_CLUB igc1
ON J1.GROUPclubID = igc1.GROUPCLUBID) T
ON u.USERID = T.MEMBERID
");
	
if (!$sql) {
  $e = oci_error();
  echo $e; 	
} 
$result = oci_execute($sql);
if (!$result) {
  $e = oci_error();
  echo $e; 	
} 

echo "<table border='1'>\n";
echo "<tr>";

echo "<th>Name</th>";
echo "<th>Moderates</th>";
echo "<th>Type</th>";
echo "<th>Member Of</th>";

echo "</tr>";
while ($row = oci_fetch_array($sql,OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
print "</table>\n";
oci_free_statement($sql);
?>