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
				
				<form action="">
					<?php
                    $IGC = $_POST['IGCListddl'];
                    $ID = $_POST['idList'];
                    
                    include 'dbconnect.php';
                    $queryIGC = "INSERT INTO MODERATESIGC(MODID, GROUPCLUBID) VALUES ($ID,$IGC)";
                    $igc = oci_parse($conn, $queryIGC);
                    $igcData = oci_execute($igc);
                    echo "Data is Submitted.";
                    
                    ?>
				</form>
				<a href="WelcomeToBackEnd.php">Go to homepage.</a>
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