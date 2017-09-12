<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		
	</head>
	
	<body>
	<!-- The Purpose of the page can be written here. -->
		<?php include "navbar.html" ?>
		
	<!-- Navigation buttons can be included here. -->	
		<nav class="firstNav">
		
		</nav>
		
	<!-- Forms can be made here. -->	
		<section>
			<div class="divInSection">
				
				<form action="AssignModToIGC_3.php" method="post">
					<?php $gcId = $_POST['IGCListddl'];  ?>
                    
                     <?php
                        include 'dbconnect.php';
                    
                    $query = "SELECT USERID FROM USER_ WHERE USERID NOT IN (SELECT MODID FROM MODERATESIGC WHERE GROUPCLUBID = $gcId)";
                    $selectIDList = oci_parse($conn, $query);
                    
                    if(!$selectIDList){
                        $e = oci_error();
                        echo $e;
                    }
                    
                    $idListResult = oci_execute($selectIDList);
                    
                      if (!$idListResult) {
                          $e = oci_error();
                          echo $e; 	
                        }     
                        
                     echo'<select name="idList">';
                     echo'<option selected="selected">select an ID</option>';
                     while ($idList = oci_fetch_array($selectIDList,OCI_ASSOC+OCI_RETURN_NULLS))
                        {
                         foreach($idList as $id)
                            {      
                             echo '<option value="' . ($id !== null ? htmlentities($id,ENT_QUOTES):"&nbsp") . '">'
                                    . ($id !== null ? htmlentities($id,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                     echo"</select>";
                     oci_free_statement($selectIDList); 
                    ?>
                    <input type="hidden" name="IGCListddl" value="<?php echo $gcId?>">
                    <input type="submit" name="submit">
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