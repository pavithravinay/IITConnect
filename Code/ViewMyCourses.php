<?php
// Start the session
session_start();
?>
<?php include "navbar.html" ?>
<br><br>
<?php
include 'dbconnect.php';
 $studentId = $_SESSION["UserId"];

$sql = oci_parse($conn, "SELECT e.courseID, c.title
FROM ENROLLED e
INNER JOIN course c
ON e.COURSEID = c.ID AND e.STUDENTID = $studentId");
	
if (!$sql) {
  $e = oci_error();
  echo $e; 	
} //if (!$stid) {
$result = oci_execute($sql);
if (!$result) {
  $e = oci_error();
  echo $e; 	
} 

print "<section><table border='1'>\n";
echo "<th>CourseID</th>";
echo "<th>Title</th>";
while ($row = oci_fetch_array($sql,OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
print "</table></section>\n";
oci_free_statement($sql);
?>

<section>
    <br>
<a href="Profile.php">Go to Home Page</a>
</section>