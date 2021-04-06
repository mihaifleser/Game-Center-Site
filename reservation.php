<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Permanent+Marker&display=swap" rel="stylesheet">
	<link rel = "stylesheet" href = "css/index.css">
  </head>
  
  <body>
  
    <main>
	<?php include "menuBar.php" ?>
      <!-- ***********************  ABOUT / PROFILE  *********************** -->

      <header>
		<div class = "section1">
		
			<h1 style = "font-size:48px;font-style:bold;">Faceti o rezervare acum!</h1>
			
			
		</div>
	  </header>
	  <section class = "section1">
		<div class = "wrap">
		<form action="submitReservation.php" id = "form" method = "post">
			
			<input type = "hidden" value = <?php echo $_POST["gameId"];?> name = "gameId">
			
			<h3><?php echo $_POST["gameName"];?></h3>
			
			<p>Data si ora</p>
			<input type = "datetime-local" name = "reservationDate" id = "reservationDate" onchange = "checkReservationDate()"></input>
			<img src="Images/cross.png" id="dateTick" value = "false" class = "tickImage">
			<br>
			<br>
			<p>Alege locatia: </p>
			<select name="location" id = "location">
			</select>
			<br> <br>
			
			
			<p>Alege card: </p>
			<select name="card" id = "card" onchange = "changeCard()">
			</select>
			<br><br>
			<p>Numar card</p>
			<input type = "text"  name = "cardNumber" id = "cardNumber" oninput = "checkCardNumber()"> </input>
			<img src="Images/cross.png" id="cardNumberTick" value = "false" class = "tickImage">
			<br><br>
			<p>CVC</p>
			<input type = "text"  name = "CVC" id = "CVC" oninput = "checkCVC()"> </input>
			<img src="Images/cross.png" id="CVCTick" value = "false" class = "tickImage">
			<br><br>
			<p>Nume</p>
			<input type = "text" name = "cardName" id = "cardName" oninput = "checkCardName()"> </input>
			<img src="Images/cross.png" id="cardNameTick" value = "false" class = "tickImage">
			<br><br>
			<p>Expirare</p>
			<input type = "date" name = "expirationDate" id = "expirationDate" onchange = "checkExpirationDate()"> </input>
			<img src="Images/cross.png" id="expirationDateTick" value = "false" class = "tickImage">
			<br>
			<br>
			<input type = "checkbox" name = "checkBox" >Salvare card</input> 
			<br>
			
			<br>
			<button name= "button" type= "button" onclick = "submitToForm()">Rezerva acum!</button>
			<br><br> 
		</form>
		</div>
	</section>
      <!-- ********************  PROJECTS / PORTFOLIO  ********************* -->
      <footer>
		<div class = "wrap">
			<h2>Contacteaza-ne acum!</h2>

			<!-- Social media and contact links. Add or remove any networks. -->
			<ul class = "contact_list">
			  <li ><a class = "flex_item" >gamecenter@yahoo.com</a></li>
			  <li ><a class = "flex_item" target="_blank">Twitter</a></li>
			  <li ><a class = "flex_item" target="_blank">LinkedIn</a></li>
			  <li ><a class = "flex_item" target="_blank">Facebook</a></li>
			</ul>
		</div>
	  </footer>
    </main>
  </body>
</html>

<?php

	require "php/db.php";

	if (session_status() == PHP_SESSION_NONE)
		session_start();
	
	if (!isset($_SESSION["name"]))
				header("Location: login.php");
		
	$locations["size"] = 0;
	$sqlLocation = mysqli_query($connection, "select * from location");
	while ($locations[$locations["size"]] = mysqli_fetch_array($sqlLocation))	
		$locations["size"]++;
		
	$cards["size"] = 0;
	$sqlCards = mysqli_query($connection, "select * from card where user_id = " . $_SESSION["id"]);
	while ($cards[$cards["size"]] = mysqli_fetch_array($sqlCards))	
		$cards["size"]++;

	
?>

<script>

	document.getElementById("dateTick").value = "false";
	document.getElementById("cardNumberTick").value = "false";
	document.getElementById("cardNameTick").value = "false";
	document.getElementById("CVCTick").value = "false";
	document.getElementById("expirationDateTick").value = "false";


	var locations = <?php echo json_encode ($locations); ?>;
	for (var i = 0; i < locations.size; i++)
	{
		var option = document.createElement("option");
		option.value = locations[i]["address"];
		option.innerHTML = locations[i]["address"];
		
		document.getElementById("location").appendChild(option);
	}
	
	var cards = <?php echo json_encode ($cards); ?>;
	
	var option = document.createElement("option");
	option.value = "Card nou";
	option.innerHTML = "Card nou";
	document.getElementById("card").appendChild(option);
	for (var i = 0; i < cards.size; i++)
	{
		var option = document.createElement("option");
		option.value = cards[i]["card_number"];
		option.innerHTML = cards[i]["card_number"];
		document.getElementById("card").appendChild(option);
	}
	
	function changeCard(){

		
		if(document.getElementById("card").options[document.getElementById("card").selectedIndex].innerHTML == "Card nou") {
			
			document.getElementById("cardNumber").value = ""; 
			document.getElementById("CVC").value = "";
			document.getElementById("cardName").value = "";
			document.getElementById("expirationDate").value = "";
			
		} else {
			
			var currCard = getCard(document.getElementById("card").value);
			document.getElementById("cardNumber").value = currCard["card_number"];
			document.getElementById("CVC").value = currCard["CVC"];
			document.getElementById("cardName").value = currCard["name"];
			document.getElementById("expirationDate").value = currCard["expiration_date"];
			
			var tempD = currCard["expiration_date"].split(" ")[0];
			
			document.getElementById("expirationDate").value = tempD; //myDate will be = 2020-08-28
			
		}
		checkCVC();
		checkCardName();
		checkCardNumber();
		checkExpirationDate();
	};
	
	function getCard(cardNumber) {
				
		for(var i = 0; i < cards.size; i++)
			if(cards[i]["card_number"] == cardNumber) 
				return cards[i];
	}
	
	function checkCardNumber() {
	
		var cardNumber = document.getElementById("cardNumber").value;
		
		if (cardNumber.length != 16) {
			document.getElementById("cardNumberTick").src = "Images/cross.png";
			document.getElementById("cardNumberTick").value = "false";
			return;
		}
		
		for (var i = 0; i < cardNumber.length; i++)
			if (cardNumber.charAt(i) < "0" || cardNumber.charAt(i) > "9") {			
				document.getElementById("cardNumberTick").src = "Images/cross.png";
				document.getElementById("cardNumberTick").value = "false";
				return;
			}

		document.getElementById("cardNumberTick").src = "Images/tick.png";
		document.getElementById("cardNumberTick").value = "true";
	}

	function checkCVC() {
	
		var cardNumber = document.getElementById("CVC").value;
		
		if (cardNumber.length != 3) {
			document.getElementById("CVCTick").src = "Images/cross.png";
			document.getElementById("CVCTick").value = "false";
			return;
		}
		
		for (var i = 0; i < cardNumber.length; i++)
			if (cardNumber.charAt(i) < "0" || cardNumber.charAt(i) > "9") {			
				document.getElementById("CVCTick").src = "Images/cross.png";
				document.getElementById("CVCTick").value = "false";
				return;
			}

		document.getElementById("CVCTick").src = "Images/tick.png";
		document.getElementById("CVCTick").value = "true";
	}
	
	function checkCardName() {
	
		var name = document.getElementById("cardName").value;
		
		if(name.length == 0)
		{
			document.getElementById("cardNameTick").src = "Images/cross.png";
			document.getElementById("cardNameTick").value = "false";
			return;
		}
		if(!((name.charAt(0) >= "A" && name.charAt(i) <= "Z") || (name.charAt(0) >= "a" && name.charAt(0) <= "z")))
		{
			document.getElementById("cardNameTick").src = "Images/cross.png";
			document.getElementById("cardNameTick").value = "false";
			return;
		}
		
		if(name.split(" ").length - 1 < 1 || name.charAt(name.length-1)== " ")
		{
			document.getElementById("cardNameTick").src = "Images/cross.png";
			document.getElementById("cardNameTick").value = "false";
			return;
		}
			
		for(var i=0; i < name.length;i++)
		{
			if ((name.charAt(i) >= "A" && name.charAt(i) <= "Z") || (name.charAt(i) >= "a" && name.charAt(i) <= "z") || name.charAt(i) == " ") {
				document.getElementById("cardNameTick").src = "Images/tick.png";
				document.getElementById("cardNameTick").value = "true";
			}
			else {
				document.getElementById("cardNameTick").src = "Images/cross.png";
				document.getElementById("cardNameTick").value = "false";
				return;
			}
		}
		
	}
	
	function checkExpirationDate() {
	
		var exp = document.getElementById("expirationDate").value;
		
		var now = new Date();
		
		if(!exp || (new Date(exp)).getTime() < now.getTime())
		{
			
			document.getElementById("expirationDateTick").src = "Images/cross.png";
			document.getElementById("expirationDateTick").value = "false";
			return;
		}
		document.getElementById("expirationDateTick").src = "Images/tick.png";
		document.getElementById("expirationDateTick").value = "true";

		
	}
	
	function checkReservationDate() {
	
		var exp = document.getElementById("reservationDate").value;
		var now = new Date();
		
		if(!exp || (new Date(exp)).getTime() < now.getTime())
		{
			
			document.getElementById("dateTick").src = "Images/cross.png";
			document.getElementById("dateTick").value = "false";
			return;
		}
		document.getElementById("dateTick").src = "Images/tick.png";
		document.getElementById("dateTick").value = "true";

		
	}
	
	function submitToForm() {
	
		if (document.getElementById("dateTick").value == "false")
			return;
			
		if (document.getElementById("CVCTick").value == "false")
			return;	
			
		if (document.getElementById("expirationDateTick").value == "false")
			return;
			
		if (document.getElementById("cardNameTick").value == "false")
			return;
		if (document.getElementById("cardNumberTick").value == "false")
			return;
	
		document.getElementById("form").submit();
	}
	
	
	
</script>
