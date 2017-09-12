<?php
    session_start();
?>
<html>
    <body>

        <?php
            include 'dbconnect.php';  
            include "navbar.html";

            $facultyId = $_SESSION['UserId'];
            $year = $_POST['year'];
            $position = $_POST['position'];
            $experience = $_POST['experience'];
            $projects = $_POST['projects'];

            $query ="INSERT INTO FACULTY(FACULTYID, YEAR, POSITION, EXPERIENCE, PROJECTS) VALUES
            ('$facultyId','$year','$position','$experience','$projects')";

            $facultyTable = oci_parse($conn, $query);

            $facultyTableData = oci_execute($facultyTable);

            if(!$facultyTableData)
            {
                echo '<h2>Error occurred while registering faculty profile. Check the data being inserted.</h2>';
                echo 'Query :' . $query;       
            }
            else
            {
                 echo '<h2>Successfully completed registering Faculty Profile</h2>';    
            }
        ?>
        
        <h3>Click below to return to login page</h3>
        <a href="Profile.php">Go to homepage</a>

    </body>
</html>