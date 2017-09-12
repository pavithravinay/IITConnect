
<?php
session_start();
 include "navbar.html" ;
?>
<html>
    <head>
        <body>
           <section>
                <form action='InsertCourseAndAutoCreateCIG.php' method="post">
                      CourseID:<br>
                      <input type="text"  name="courseIdIn" value=""><br>
                      Title:<br>
                      <input type="text" name="TitleIn" value=""><br><br>
                      <input type="submit" value="Add"><br><br>
                    <a href= "WelcomeToBackEnd.php">Go to home page</a>
                </form>    
         </section>
        </body>  
    </head>
</html>