<!DOCTYPE html>
<html>
	<head>
		<title> User Login </title>
		<center><code></code></center>
		<style>
				header {
			background-color:black;
			color:white;
			text-align:center;
			padding:25px; 
		}
		nav.firstNav {
			line-height:30px;
			background-color:LightGray;
			height:450px;
			width:250px;
			float:left;
			padding:10px; 
		}
		
		nav.secondNav {
			line-height:30px;
			background-color:LightGray;
			height:450px;
			width:250px;
			float:left;
			padding:10px; 
		}
		
		section {
			height:450px;
			width:687px;
			float:left;
			padding:10px; 
			background-color:grey;
		}
		
		footer {
			background-color:black;
			color:white;
			clear:both;
			text-align:center;
			padding:25px; 
		}
		div.divInSection {
			background-color:Silver;
			color:white;
			clear:both;
			text-align:center;
			padding:132px; 
		}
		</style>
		
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
                    Select an Interest Group below.
                    <select>
                        <option value="IG425">Interest Group 425</option>
                        <option value="IG525">Interest Group 525</option>
                        <option value="IG520">Interest Group 520</option>
                    </select>
                    <input type="submit" value="Register" name="submit">
                </form>
				
				<form action="">
					Registered Interest Groups:
                    <div>
            <!-- hyperlink subject names here -->
                    <input type="button" value="Interest Group 425">
                    </div>
                    
                    <input type="submit" value="Refresh Registered Interest Groups">
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