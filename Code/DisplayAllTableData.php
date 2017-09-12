<!DOCTYPE html>
<html>
    <head>                   
        <link href="/CS425ProjectSpring2016/Styles/css/bootstrap.css" rel="stylesheet" type="text/css">     
        <script type="text/javascript" src="/CS425ProjectSpring2016/Styles/js/jquery.js"></script>
        <script type="text/javascript" src="/CS425ProjectSpring2016/Styles/js/bootstrap.js"></script>
    </head>
    <body>
      <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">IIT User Profile</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->    
          </div><!-- /.container-fluid -->
        </nav>
        <form>
              <!-- Split button -->
            <!-- Split button -->
            <div class="btn-group">
              <button type="button" class="btn btn-danger">Select a table</button>
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">User_</a></li>
                <!--<li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>-->
              </ul>
            </div>
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default">Dispaly Table data</button>  
            </div>
            
            <?php
                include 'dbconnect.php';
                $selectCourseList = oci_parse($conn, "SELECT id FROM course");

                if (!$selectCourseList) {
                  $e = oci_error();
                  echo $e; 	
                } //if (!$selectCourseList) {
                $courseListResult = oci_execute($selectCourseList);
                if (!$courseListResult) {
                  $e = oci_error();
                  echo $e; 	
                } 

                echo'<select name="courseListddl">';
                echo'<option selected="selected">select a course</option>';

                while ($courseList = oci_fetch_array($selectCourseList,OCI_ASSOC+OCI_RETURN_NULLS))
                {

                    foreach($courseList as $courseId)
                    {
                        //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                        echo '<option value="' . ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") . '">'
                            . ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") . 
                            '</option>';
                    }

                }
                echo"</select>";
                oci_free_statement($selectCourseList);                                
          ?>
        </form>
    </body>
</html>
