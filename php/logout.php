<?php

	if (session_status() == PHP_SESSION_NONE)
		session_start();
			
	if (isset($_SESSION["name"]))
	{
		session_destroy();
		header("Location: ../index.php");
	}
	else
	{
		header("Location: ../login.php");
	}

?>