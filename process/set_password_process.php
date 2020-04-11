<?php

if (isset($_POST["set_password"])) {
	//check for inputs...
	require("db/connection.php");
	$errors = [];

	require_once("functions/functions.php");
	if (empty(verifyVisitorInput($_POST["password"]))) {
		$errors[] = "please enter your password";
	}
	if (empty(verifyVisitorInput($_POST["confirm"]))) {
		$errors[] = "Please confirm your password";
	}

	if (empty($errors)) {
		//there are inputs, continue with the process...
		$password = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["password"]));
		$confirm = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["confirm"]));

		if ($confirm === $password) {
			//then the process can continue...
			require_once("functions/functions.php");
			setPassword($password);
		}else{
			//the confirm is incorrect...
			require_once("functions/alerts.php");
			alert_error("Confirm-Password is incorrect!");
		}
	}else{
		foreach ($errors as $error) {
			require_once("functions/alerts.php");
			alert_warning($error);
		}
	}
}

