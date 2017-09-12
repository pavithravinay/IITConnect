<?php
include 'dbconnect.php';


$sql = oci_parse($conn, "SELECT * FROM (
SELECT * FROM
(SELECT c.comments, c2.NAME,'CIG' AS type,c.DATEANDTIME FROM comments c
INNER JOIN topic t
ON c.TOPICID = t.TOPICID
INNER JOIN COURSEINTERESTGROUP_HAS c1
ON c1.FORUMID = t.FORUMID
INNER JOIN COURSEINTERESTGROUP c2
ON c1.GROUPID = c2.GROUPID
INNER JOIN JOINSCIG J
ON J.GROUPID = c1.GROUPID
INNER JOIN student s 
ON s.STUDENTID = c.COMMENTEDBY
WHERE s.STUDENTID = 1
--order by c.DATEANDTIME desc
UNION
SELECT c.comments, i2.NAME,CASE i2.type WHEN 'group' THEN 'group'
ELSE 'club' END AS type, c.DATEANDTIME FROM comments c
INNER JOIN topic t
ON c.TOPICID = t.TOPICID
INNER JOIN INTERESTGROUPCLUB_HAS i1
ON i1.FORUMID = t.FORUMID
INNER JOIN INTERESTGROUP_CLUB i2
ON i1.GROUPCLUBID = i2.GROUPCLUBID
INNER JOIN JOINS J
ON J.GROUPCLUBID = i1.GROUPCLUBID
INNER JOIN student s 
ON s.STUDENTID = c.COMMENTEDBY
WHERE s.STUDENTID = 1)
order by DATEANDTIME desc
)
WHERE ROWNUM <= 5");
	
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
echo "<th>Comment</th>";
echo "<th>Group/Club Name</th>";
echo "<th>Type</th>";
echo "<th>DateTime</th>";
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