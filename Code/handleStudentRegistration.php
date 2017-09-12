
<?php
    session_start();

?>
<html>

<body>

    <?php
    include 'dbconnect.php';
    include "navbar.html";
    $studentId = $_SESSION['userId'];
    $year = intval($_POST['year']);
    $semester =$_POST['semester'];
    $gpa = $_POST['gpa'];
    $degreeStatus = $_POST['degreeStatus'];
    $degreeType = $_POST['degreeType'];
    $jobs = $_POST['jobs'];
    $showGpa = $_POST['showGpa'];
    $showGroupClub =  $_POST['showGroupClub'];
    $showCourseInterestGroup = $_POST['showCourseInterestGroup'];
    
    
    $course1 = $_POST['Course1'];
    if($course1 == 'Select a Course')
    {
        $course1 = 'NULL';
    }
    $course2 = $_POST['Course2'];
    if($course2 == 'Select a Course')
    {
        $course2 = 'NULL';
    }
    $course3 = $_POST['Course3'];
    if($course3 == 'Select a Course')
    {
        $course3 = 'NULL';
    }
    
    

    
    $query = "BEGIN ProjectRegisterStudentProfile($studentId,'test',$year,'$semester',$gpa,'abc@abc.com','$degreeStatus','$degreeType',$course1,$course2,$course3,1,'$jobs',1,'Grad','test prok','Student','$showGpa','$showGroupClub','$showCourseInterestGroup',:un,:pw); END;";   
//    echo $query;
    
   
    
    $studentTable = oci_parse($conn, $query);
    
    oci_bind_by_name($studentTable, ':un', $un,2000);
    oci_bind_by_name($studentTable, ':pw', $pw,2000);
    
    $studentTableData = oci_execute($studentTable);
    
    if(!$studentTableData)
    {
        echo '<h1>Error occurred while registering student profile. Check the data being inserted.</h1>';
        echo 'Query :' . $query;       
    }
    else
    {
        echo "<section>";
        echo '<h2>Successfully completed registering Student Profile</h2>';   
        echo "</section>";
    }
    
    ?>
    <section><h3>Click below to return to home page</h3>
    <a href="Profile.php">Go to homepage</a>
    </section>
    
    
</body>

</html>