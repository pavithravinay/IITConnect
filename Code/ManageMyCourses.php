<?php
// Start the session
session_start();
?>
<?php include "navbar.html" ?>
<?php
include 'dbconnect.php';
 $UserId = $_SESSION["UserId"];

$sql = oci_parse($conn, "SELECT t.COURSEID, c.title 
FROM teaches t
INNER JOIn Course c
ON t.COURSEID = c.ID
WHERE facultyID = $UserId");
	
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

while ($row = oci_fetch_array($sql,OCI_BOTH)) {
    $courseId = $row[0];    
    $title = $row[1];
    echo "<tr>\n";
    echo "    <td>".($courseId !== null ? htmlentities($courseId, ENT_QUOTES) : "&nbsp;"). "</td>\n";       
    echo "    <td>".'<a href= "AssignTA.php?courseId=' . $courseId .'">'.($title !== null ? htmlentities($title, ENT_QUOTES) : "&nbsp;").'</a>'. "</td>\n";
    echo "</tr></section>\n";
}

echo "</table>\n";
//echo 'UserName'.'<input type=" '.text'".value="'username'".name="'UserName'">';
oci_free_statement($sql);
?>
<a href="Profile.php">Go to Home Page</a>