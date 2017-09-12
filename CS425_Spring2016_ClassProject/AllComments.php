<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<header>
		
		</header>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="">
					List of all Comments:
                    
                    <?php
                    error_reporting(E_ALL & ~E_NOTICE);
                    echo "<html>";
                    echo "<body>";    
                    
                        
                    include 'dbconnect.php';    
                    $getAllComments = "SELECT COMMENTEDBY, COMMENTS, DATEANDTIME FROM COMMENTS";
                    
                    $allComments = oci_parse($conn, $getAllComments);
                    $allCommentsResult = oci_execute($allComments);
                    //$allCommentsResultRow = //oci_fetch_array($allComments, OCI_BOTH);
                    
                    $size = 100;
                    $resultArr = array();
                    $resultArr = array_fill(0, $size, NULL);
                    
                    $ctr = 0;
                    while($row = oci_fetch_array($allComments,OCI_BOTH)){
                       // $resultArr[$ctr] = array($row[0],$row[1],$row[2]);
                        $ctr++;
                    }
                    
                    $_SESSION['resultArr']=$resultArr;
                    
                    
                    $secondExecution = oci_execute($allComments);
                    
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Comment By</th><th>Comment</th><th>Commented At</td>"    ;
                    echo "</tr>"    ;
                    
                    
                    while ($commentList = oci_fetch_array($allComments,OCI_BOTH))
                        {

                           // echo $commentList[0];
                               echo "<tr>";
                               echo "<td>".$commentList[0]."</td>"; 
                               echo "<td>".$commentList[1]."</td>"; 
                               echo "<td>".$commentList[2]."</td>";    
                               echo "</tr>";
                            

                        }
                         echo "</table>";
                    
                    oci_free_statement($allComments);
                    
                    if(!$allComments){
                        echo "Wrong.";
                    }else{
                       // echo "Right.";
                    }
                    
                      if(!$allCommentsResult){
                        echo "Wrong.";
                    }else{
                       // echo "Right.";
                    }
                    
                      /*if(!$allCommentsResultRow){
                        echo "Wrong.";
                    }else{
                        echo "Right.";
                    }*/
                        
                  
                    echo "</body>";
                    echo "</html>";
                    ?>
                    
				</form>
				
			</div>
		</section>
		
	<!-- More navigation options can be included here. -->
		<nav class="secondNav">
		
		</nav>
		
	<!-- This place can contain messages or buttons. -->	
		<footer>
		
		</footer>
	</body>
</html>