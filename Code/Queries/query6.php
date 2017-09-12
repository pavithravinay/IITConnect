<?php
include 'dbconnect.php';


$sql = oci_parse($conn, "SELECT CG.name, 'CourseInterestGroup' AS type FROM COURSEINTERESTGROUP CG WHERE CG.GROUPID 
  IN (SELECT groupID FROM COURSEINTERESTGROUP_HAS CI WHERE CI.FORUMID 
      IN (SELECT forumID FROM topic T WHERE T.TOPICID 
          IN (SELECT topicID FROM
              (SELECT topicId, COUNT(*) AS numOfComments FROM comments
              GROUP BY topicID
              ORDER BY numOfComments desc)T
              WHERE ROWNUM = 1)))
UNION
SELECT IC.name, 
CASE IC.type WHEN 'group' THEN 'group'
ELSE 'club' END AS type FROM INTERESTGROUP_CLUB IC WHERE IC.GROUPCLUBID 
  IN (SELECT GC.GROUPCLUBID FROM INTERESTGROUPCLUB_HAS GC WHERE GC.FORUMID 
      IN (SELECT forumID FROM topic T WHERE T.TOPICID 
          IN (SELECT topicID FROM
              (SELECT topicId, COUNT(*) AS numOfComments FROM comments
              GROUP BY topicID
              ORDER BY numOfComments desc)T
              WHERE ROWNUM = 1)))");
	
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
echo "<th>Type</th>";
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