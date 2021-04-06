<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapo Games</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Permanent+Marker&display=swap" rel="stylesheet">
	<link rel = "stylesheet" href = "css/index.css">
  </head>
  
  <body>
    <main>
		<?php include "menuBar.php" ?>
      <!-- ***********************  ABOUT / PROFILE  *********************** -->
		
		

      <header>
		<div class = "wrap">
		
			<h1>Lapo Games</h1>
			<h2>Sala de jocuri si evenimente</h2>

			<p>Vrei sa tragi un chef cu prietenii? Programeaza-te la noi! Aici puteti juca biliard, ping-pong, jocuri pe consola, jocuri de societate si jocuri de noroc!</p>
			<p>Preturi accesibile si oferte atractive tot anul!</p>
		</div>
	  </header>

      <!-- ********************  PROJECTS / PORTFOLIO  ********************* -->
      <section class= "section1">
		<div class = "wrap divider" id = "gamePackages">
			<h2>Pachete de jocuri</h2>
		</div>	
      </section>

      
		
      <!-- ******************  EDUCATION & CERTIFICATIONS ****************** -->
      <section  class = "section3">
		<div class = "wrap">
			<h2>Contact</h2>

			<!-- Copy this whole <section> block to add more schools. -->
			<section>
			  <h3>Mihai Fleser</h3>
			  <p>Nr tel - 0700 00 00 00</p>
			</section>
			
			<section>
			  <h3>Rares-Mihai Paltineanu</h3>
			  <p>Nr tel - 0711 11 11 11</p>
			</section>
			
			<section>
			  <h3>Alexandru Presecan</h3>
			  <p>Nr tel - 0722 22 22 22</p>
			</section>
			
			<!-- End of School block. -->
		</div>
	  </section>

      <!-- *****************  CONTACT INFO / SOCIAL MEDIA  ***************** -->
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
	
	$sql = mysqli_query($connection, "select * from games_package");
	$gamePackages["size"] = 0;
	
	while ($gamePackages[$gamePackages["size"]] = mysqli_fetch_array($sql))	
		$gamePackages["size"]++;
	
?>

<script>

	var gamePackages = <?php echo json_encode($gamePackages); ?>;
	
	for (var i = 0; i < gamePackages.size; i++)
	{
		var gamePackageSection = document.createElement("section");
		
		var image = document.createElement("img");
		image.src = "Images/" + gamePackages[i]["image"];
		gamePackageSection.appendChild(image);
		
		var header = document.createElement("h3");
		var node = document.createTextNode(gamePackages[i]["name"]);
		header.appendChild(node);
		gamePackageSection.appendChild(header);
		
		var description = document.createElement("p");
		node = document.createTextNode(gamePackages[i]["description"]);
		description.appendChild(node);
		gamePackageSection.appendChild(description);
		
		var price = document.createElement("p");
		node = document.createTextNode("Price: " + gamePackages[i]["price"]);
		price.appendChild(node);
		gamePackageSection.appendChild(price);
		
		var button = document.createElement("input");
		button.type = "submit";
		button.value = "Details";
		
		var gameId = document.createElement("input");
		gameId.type = "hidden";
		gameId.value = gamePackages[i]["id"];
		gameId.name = "gameId";
		
		var gameName = document.createElement("input");
		gameName.type = "hidden";
		gameName.value = gamePackages[i]["name"];
		gameName.name = "gameName";
		
		var form = document.createElement("form");
		form.appendChild(gameId);
		form.appendChild(button);
		form.appendChild(gameName);
		form.method = "post";
		form.action = "gamePackage.php";
		
		gamePackageSection.appendChild(form);
		
		document.getElementById("gamePackages").appendChild(gamePackageSection);
	}
	
</script>
