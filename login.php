<!DOCTYPE html>

<html lang="en">

	
	<head> 
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Permanent+Marker&display=swap" rel="stylesheet">
	<link rel = "stylesheet" href="css/index.css?version=1">
		
	</head>
	
	<body> 
	
	
	<?php include "menuBar.php" ?>
		<div class = "section1">
		
		<h1 class = "header" font>
			<p style = "font-size:48px;font-style:bold;">
         Login
      </p>
		</h1>
			<form action="php/login.php" method = "post">
				<label> Email: </label><br>
				<input type= "text" id= "email" name= "email"><br><br>
				<label> Password: </label><br>
				<input type= "password" id= "password" name= "password"> <br>
				<input type="checkbox" onclick="showPassword()">Show Password</input><br><br>
				<label><?php 
				if (session_status() == PHP_SESSION_NONE)
					session_start(); 
				if(isset($_SESSION["account"]))
					echo $_SESSION["account"];?></label>
				
				<br><input name= "submit" type= "submit" value = "Login"><br><br>  
		
			</form>
			
			
		</div>	
		
		
	</body>
	
</html>

<script>
	
	function showPassword() 
	{
		var inputText = document.getElementById("password");
		
		if (inputText.type === "password")
			inputText.type = "text";
		else
			inputText.type = "password";
	}
	
</script>