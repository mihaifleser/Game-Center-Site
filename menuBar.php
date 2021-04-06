<!DOCTYPE html>
<html lang="en">

  <head>
	<link rel="stylesheet" href="css/index.css?version=2">
  </head>
  
  <body>
    <main>
      <!-- ***********************  ABOUT / PROFILE  *********************** -->
	  
		<section> <div class = "menu">
			<ul>
				<li>
					<a href = "index.php" style = "float: left">Home</button>
				</li>
				<li>
					<a href="php/logout.php" style = "float: right"><?php 
						
							if (session_status() == PHP_SESSION_NONE)
								session_start();

							if (isset($_SESSION["name"]))
								echo "Logout";
							else
								echo "Login";

					?> </a>
					</form>
				</li>
				<li>
					<a href = "signup.php" style = "float: right"> <?php 
				
						if (session_status() == PHP_SESSION_NONE) {
							session_start();
						}
						
						if (isset($_SESSION["name"]))
							echo $_SESSION["name"];
						else
							echo "Sign Up";
					
					?> </a>
				</li>
			</ul>
		
		</section> </div>
		
      <main>
	<body>
</html>