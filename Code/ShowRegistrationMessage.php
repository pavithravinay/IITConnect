<!DOCTYPE html>
<html>
	<head>
		<title> Registration Message </title>
		<center><code></code></center>
<!--		<link href="/CS425ProjectSpring2016/styles/css/site.css" rel="stylesheet" type="text/css">-->
		
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
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">                      
                    
                    <?php
                    
                        include 'dbconnect.php';
                        $userId = $_POST['userId'];
                        $type = $_POST['groupType'];
                        
                        
                    
                        $insertIntojoinsCIG = "INSERT INTO JOINSCIG (MEMBERID, GROUPID, USERNAME, PASSWORD,APPROVALSTATUS)
                                                    VALUES (:userId_bv,:groupId_bv,'UserName1','Password@123','N')";
                        $insertIntojoins = "INSERT INTO JOINS (MEMBERID, GROUPCLUBID, USERNAME, PASSWORD,APPROVALSTATUS)
                                                    VALUES (:userId_bv,:groupClubId_bv,'UserName1','Password@123','N')";
                    
                        if($type == "CIG")
                        {

                            $groupId = $_POST['courseInterestGroupListddl']; 
                            
                            $sql = oci_parse($conn, $insertIntojoinsCIG);

                                if (!$sql) {
                                  $e = oci_error();
                                  echo $e; 	
                                } 
                                oci_bind_by_name($sql,":userId_bv",$userId);
                                oci_bind_by_name($sql,":groupId_bv",$groupId);                        

                                $sqlResult = oci_execute($sql);

                                if (!$sqlResult) {
                                  $e = oci_error();
                                  echo $e; 	
                                  echo 'Error while registering to course interest group';
                                } 
                                else
                                {
                                    echo 'Request sent to moderator for approval.';
                                }
                                oci_free_statement($sql); 
                        }
                        else
                        {
                            $groupClubId = $_POST['IGCListddl'];    
                            $sql = oci_parse($conn, $insertIntojoins);

                                if (!$sql) {
                                  $e = oci_error();
                                  echo $e; 	
                                } 
                                oci_bind_by_name($sql,":userId_bv",$userId);
                                oci_bind_by_name($sql,":groupClubId_bv",$groupClubId);                        

                                $sqlResult = oci_execute($sql);

                                if (!$sqlResult) {
                                  $e = oci_error();
                                  echo $e; 	
                                  echo 'Error while registering to interest group club';
                                } 
                                else
                                {
                                    echo 'Request sent to moderator for approval';
                                }
                             oci_free_statement($sql); 
                        }
                    
                ?>
                    <!-- Todo: Check what should be the home page. -->
                    <a href="Profile.php">Go to Home Page</a>
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