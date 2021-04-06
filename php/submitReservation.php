<?php

	require "db.php";

	if (session_status() == PHP_SESSION_NONE)
		session_start();
		
	if (!isset($_SESSION["id"]) or !isset($_POST["reservationDate"]) or !isset($_POST["gameId"]) or !isset($_POST["location"]) or !isset($_POST["cardNumber"]) or !isset($_POST["CVC"]) or !isset($_POST["cardName"]) or !isset($_POST["expirationDate"]))
		$print = "Error";
	else
	{
		$sql = mysqli_query($connection, "select id from location where address = '" .$_POST["location"]. "'");
		if (mysqli_num_rows($sql))
		{
			$row = mysqli_fetch_assoc($sql);
		}
		
		$sql = mysqli_query($connection, "insert into reservation (user_id, package_id, location_id, date) values ('" . $_SESSION["id"] . "', '" . $_POST["gameId"] . "', '" . $row["id"] . "', '" . $_POST["reservationDate"] . "')");
		
		if(isset($_POST["checkBox"]) AND $_POST["checkBox"] == true) {
			
			$sql = mysqli_query($connection, "select card_id from card where card_number = '" .$_POST["cardNumber"]. "' AND user_id =  '" . $_SESSION["id"] . "' AND CVC = '" . $_POST["CVC"] ."'");
			
			if(mysqli_num_rows($sql) == 0)
				$sql = mysqli_query($connection, "insert ignore into card (user_id, card_number, CVC, name, expiration_date) values ('" . $_SESSION["id"] . "', '" . $_POST["cardNumber"] . "', '" . $_POST["CVC"] . "', '" . $_POST["cardName"] ."', '". $_POST["expirationDate"] . "')");
		}
		
		$print = "Multumim pentru rezervare";
	}	
?>

<html>

<body>

	<h1 type = "hidden"> <?php echo $print ?> </h1>
</body>

</html>