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
				
				<form action="AssignModToIGC_2.php" method="post">
					
                    <?php
                    include 'dbconnect.php';
                    $selectInterestGroupClub = oci_parse($conn, "SELECT GROUPCLUBID FROM INTERESTGROUP_CLUB");
                    
                    if(!$selectInterestGroupClub)
                    {
                        $e = oci_error();
                        echo $e;
                    }
                    
                    $InterestGroupClubResult = oci_execute($selectInterestGroupClub);
                    if(!$InterestGroupClubResult)
                    {
                        $e = oci_error();
                        echo $e;
                    }
                    
                     echo'<select name="IGCListddl">';
                        echo'<option selected="selected">select an Interest Group or Club</option>';

                        while ($igcList = oci_fetch_array($selectInterestGroupClub,OCI_ASSOC+OCI_RETURN_NULLS))
                        {

                            foreach($igcList as $igcId)
                            {
                                //echo ($courseId !== null ? htmlentities($courseId,ENT_QUOTES):"&nbsp") ;
                                echo '<option value="' . ($igcId !== null ? htmlentities($igcId,ENT_QUOTES):"&nbsp") . '">'
                                    . ($igcId !== null ? htmlentities($igcId,ENT_QUOTES):"&nbsp") . 
                                    '</option>';
                            }

                        }
                        echo"</select>";
                        oci_free_statement($selectInterestGroupClub);      
                    
                    ?>
                   
                    <input type="submit" name="submit" value="submit">
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