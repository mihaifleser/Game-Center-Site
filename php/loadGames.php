<?php

	require "php/db.php";

	if (session_status() == PHP_SESSION_NONE)
		session_start();
	
	$sql = mysqli_query($connection, "select * from game where package_id = " . $_POST["gameId"]);
	$games["size"] = 0;
	
	while ($games[$games["size"]] = mysqli_fetch_array($sql))
		$games["size"]++;

	$_SESSION["games"] = $games;
	
	header("Location: http://localhost/LapoGames/index.php");
	
?>