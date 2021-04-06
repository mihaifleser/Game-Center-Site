<!DOCTYPE html>

<html lang="en">
	
		<?php include "menuBar.php" ?>
	<head> 
		<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Permanent+Marker&display=swap" rel="stylesheet">
		<link rel = "stylesheet" href="css/index.css?version=1">
	
	</head>
	
	<body> 
		<div class = "section1">
		
			<h1 class = "header" font>
				<p style = "font-size:48px;font-style:bold;">
				Sign Up
				</p>
				
			</h1>
			<form action="php/signup.php" method = "post" id = "form" >
			
				<label> email: </label><br>
				<input type= "text" id= "email" name = "email" oninput = "validateEmail()">
				<img src="Images/cross.png" id="emailTick" value = "false" class = "tickImage">
				<br><br>
				
				<label> name: </label><br>
				<input type= "text" id= "name" name = "name" oninput = "validateName()">
				<img src="Images/cross.png" id="nameTick" value = "false" class = "tickImage">
				<br><br>
				
				<label> password: </label><br>
				<input type= "password" id= "password" name= "password" oninput = "validatePassword()">
				<img src="Images/cross.png" id="passwordTick" value = "false" class = "tickImage">
				<br>
				<input type="checkbox" onclick="showPassword()">Show Password</input><br><br>
				
				<label> repeat password: </label><br>
				<input type= "password" id= "password2" name= "password2" oninput = "validatePassword()">
				
				<br><br>
				
				<label> phone: </label><br>
				<input type= "text" id= "phone" name= "phone" oninput = "validatePhone()">
				<img src="Images/cross.png" id="phoneTick" value = "false" class = "tickImage">
				<br><br>
				
				<button type= "button" onclick = "submitToForm()">Sign up</button><br><br> 			
			</form>
		</div>	
	</body>
	
</html>

<script>
	
	document.getElementById("phoneTick").value = "false";
	document.getElementById("emailTick").value = "false";
	document.getElementById("nameTick").value = "false";
	document.getElementById("passwordTick").value = "false";
	
	function showPassword() {
	
		var inputText = document.getElementById("password");
		var inputText2 = document.getElementById("password2");
		
		if (inputText.type == "password")
		{
			inputText.type = "text";
			inputText2.type = "text";
		}
		else
		{
			inputText.type = "password";
			inputText2.type = "password";
		}
	}
	
	function validateName() {
	
		var name = document.getElementById("name").value;
		
		if (name.charLength != 0 && ((name.charAt(0) >= "A" && name.charAt(0) <= "Z") || (name.charAt(0) >= "a" && name.charAt(0) <= "z"))) {
			document.getElementById("nameTick").src = "Images/tick.png";
			document.getElementById("nameTick").value = "true";
		}
		else {
			document.getElementById("nameTick").src = "Images/cross.png";
			document.getElementById("nameTick").value = "false";
		}
	}
	
	function validatePassword() {
		
		var inputText = document.getElementById("password");
		var inputText2 = document.getElementById("password2");
		if (inputText.value == inputText2.value && inputText.value.length > 0) {
			document.getElementById("passwordTick").src = "Images/tick.png";
			document.getElementById("passwordTick").value = "true";
		}
		else {
			document.getElementById("passwordTick").src = "Images/cross.png";
			document.getElementById("passwordTick").value = "false";
		}
	}
	
	function validateEmail() {
	
		var email = document.getElementById("email").value;
		const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if (re.test(String(email).toLowerCase())) {
			document.getElementById("emailTick").src = "Images/tick.png";
			document.getElementById("emailTick").value = "true";
		}                           
		else {                      
			document.getElementById("emailTick").src = "Images/cross.png";
			document.getElementById("emailTick").value = "false";
		}
	}
	
	function validatePhone() {
	
		var phone = document.getElementById("phone").value;
		
		if (phone.length != 10) {
			document.getElementById("phoneTick").src = "Images/cross.png";
			document.getElementById("phoneTick").value = "false";
			return;
		}
		
		for (var i = 0; i < phone.length; i++)
			if (phone.charAt(i) < "0" || phone.charAt(i) > "9") {			
				document.getElementById("phoneTick").src = "Images/cross.png";
				document.getElementById("phoneTick").value = "false";
				return;
			}

		document.getElementById("phoneTick").src = "Images/tick.png";
		document.getElementById("phoneTick").value = "true";
	}
	
	function submitToForm() {
	
		if (document.getElementById("phoneTick").value == "false")
			return;
			
		if (document.getElementById("emailTick").value == "false")
			return;	
			
		if (document.getElementById("nameTick").value == "false")
			return;
			
		if (document.getElementById("passwordTick").value == "false")
			return;
	
		document.getElementById("form").submit();
	}
	
</script>