<?php

	require "db.php";
	
	if (session_status() == PHP_SESSION_NONE)
			session_start();
			
	if (!isset($_POST["email"]) or !isset($_POST["password"]) or !isset($_POST["password2"]) or !isset($_POST["name"]))
		echo "Error";
	else
	{
		
		$sql = mysqli_query($connection, "select id from user where email = '" .$_POST["email"]. "'");
			
		if(mysqli_num_rows($sql) == 0) {
			
			$sql = mysqli_query($connection, "insert into  user (email, name, password, telephone) values ('" . $_POST["email"] . "', '" . $_POST["name"] . "', '" . $_POST["password"] . "', '" . $_POST["phone"] . "')");
			$sql = mysqli_query($connection, "select * from user where email = '" . $_POST["email"] . "' and password = '" . $_POST["password"] . "'");
		
			if ($sql and mysqli_num_rows($sql))
			{
				$row = mysqli_fetch_assoc($sql);
				if (session_status() == PHP_SESSION_NONE)
					session_start();
				$_SESSION["name"] = $row["name"];
				$_SESSION["id"] = $row["id"];
				header("Location: ../index.php");
			//echo $row["email"] . "account created";
			}
			else
			{
				echo "esuare";
			}	
		} else 
			echo "Cont deja existent";
	}	
?>