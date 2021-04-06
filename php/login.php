<?php

require "db.php";

if (!isset($_POST["email"]) or !isset($_POST["password"]))
	echo "Error";
else
{
	$sql = mysqli_query($connection, "select * from user where email = '" . $_POST["email"] . "' and password = '" . $_POST["password"] . "'");
	if (session_status() == PHP_SESSION_NONE)
			session_start();
	if (mysqli_num_rows($sql))
	{
		$row = mysqli_fetch_assoc($sql);
		echo $row["email"];
		
		
			
		$_SESSION["name"] = $row["name"];
		$_SESSION["id"] = $row["id"];
		header("Location: ../index.php");
	}
	else
	{
		$_SESSION["account"] = "Invalid email or password";
		echo "inexistent account";
		header("Location: ../login.php");
	}
	
}	

?>