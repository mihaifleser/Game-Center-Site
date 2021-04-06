<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapo Games</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Permanent+Marker&display=swap" rel="stylesheet">
	<link rel = "stylesheet" href="css/index.css?version=1">
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
		<div class = "wrap divider" id = "games">
			<h2><?php echo $_POST["gameName"];?></h2>
		</div>	
      </section>
	  
	  
	   <section class= "section1">
		<div class = "wrap divider">
			<form action="reservation.php" method = "post">
			<input type = "hidden" value = <?php echo json_encode($_POST["gameName"]);?> name = "gameName">
			<input type = "hidden" value = <?php echo $_POST["gameId"];?> name = "gameId">
			<input name= "submit" type= "submit" style="position: center;" value = "Rezerva Acum!"></input><br><br> 
		</form>
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
			  <li ><a class = "flex_item" href="mailto:gamecenter@yahoo.com">gamecenter@yahoo.com</a></li>
			  <li ><a class = "flex_item" href="#" target="_blank">Twitter</a></li>
			  <li ><a class = "flex_item" href="#" target="_blank">LinkedIn</a></li>
			  <li ><a class = "flex_item" href="#" target="_blank">Facebook</a></li>
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
	
	$sql = mysqli_query($connection, "select * from game where package_id = " . $_POST["gameId"]);
	$games["size"] = 0;
	
	while ($games[$games["size"]] = mysqli_fetch_array($sql))
		$games["size"]++;
	
?>

<script>
	
	var games = <?php echo json_encode($games); ?>;
	
	for (var i = 0; i < games.size; i++)
	{
		console.debug(i);
		var gameSection = document.createElement("section");
		
		
		
		var header = document.createElement("h3");
		var node = document.createTextNode(games[i]["name"]);
		header.appendChild(node);
		gameSection.appendChild(header);
		
		var description = document.createElement("p");
		node = document.createTextNode(games[i]["description"]);
		description.appendChild(node);
		gameSection.appendChild(description);
		
		var image = document.createElement("img");
		image.src = "Images/" + games[i]["image"];
		gameSection.appendChild(image);
		
		document.getElementById("games").appendChild(gameSection);
	}

</script>