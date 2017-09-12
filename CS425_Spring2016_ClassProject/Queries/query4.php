<?php
include 'dbconnect.php';


$sql = oci_parse($conn, "/*SELECT facultyID, courseID,avggpa ,'minGPA' AS minORmax, 'per faculty' AS facultyType
FROM teaches 
WHERE facultyid = 4 AND avggpa = (SELECT MIN(avggpa) FROM teaches WHERE FACULTYID = 4)
UNION
SELECT facultyID, courseID,avggpa, 'maxGPA' AS minORmax, 'per faculty' AS facultyType
FROM teaches 
WHERE facultyid = 4 AND avggpa = (SELECT MAX(avggpa) FROM teaches WHERE FACULTYID = 4)
UNION*/

SELECT T3.facultyID, T3.courseID,T3.avggpa, 'maxGPA' AS minORmax--, 'all faculties' AS facultyType
FROM teaches T3
WHERE NOT EXISTS
(SELECT distinct T1.facultyID, T1.courseID, T1.avggpa 
FROM teaches T1
INNER JOIN teaches T2
ON T1.FACULTYID = T2.FACULTYID 
WHERE T1.AVGGPA < T2.AVGGPA AND T3.facultyID = T1.FacultyID AND T3.courseID = T1.courseID AND T3.avggpa = T1.avggpa)
UNION
SELECT T3.facultyID, T3.courseID,T3.avggpa, 'minGPA' AS minORmax--, 'all faculties' AS facultyType
FROM teaches T3
WHERE NOT EXISTS
(SELECT distinct T1.facultyID, T1.courseID, T1.avggpa 
FROM teaches T1
INNER JOIN teaches T2
ON T1.FACULTYID = T2.FACULTYID 
WHERE T1.AVGGPA > T2.AVGGPA AND T3.facultyID = T1.FacultyID AND T3.courseID = T1.courseID AND T3.avggpa = T1.avggpa)");
	
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
echo "<th>CourseId</th>";
echo "<th>Average GPA</th>";
echo "<th>min OR max GPA</th>";
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