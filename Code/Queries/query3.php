<?php
include 'dbconnect.php';


$sql = oci_parse($conn, "SELECT t.facultyID, u.name, AVG(avggpa)
FROM teaches t
INNER JOIN User_ u
ON t.facultyId = u.userId
GROUP BY FACULTYID, u.name");
	
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
echo "<th>FacultyId</th>";
echo "<th>Faculty Name</th>";
echo "<th>Average GPA</th>";
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