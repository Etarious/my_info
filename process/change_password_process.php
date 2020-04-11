<?php

if (isset($_POST["change_password"])) {
	//get the db...
	require("db/connection.php");

	//verify the inputs...
	$errors = [];

	require_once("functions/functions.php");
	if (empty(verifyVisitorInput($_POST["old"]))) {
		$errors[] = "please enter your old password";
	}
	if (empty(verifyVisitorInput($_POST["new"]))) {
		$errors[] = "please enter your new password";
	}
	if (empty(verifyVisitorInput($_POST["confirm"]))) {
		$errors[] = "please confirm your password";
	}

	if (empty($errors)) {
		//There are no empty inputs, continue with the process...
		$old_password = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["old"]));
		$new_password = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["new"]));
		$confirm = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["confirm"]));

		//check if the old password is correct...
		require_once("functions/functions.php");
		if (checkPasswordCorrect($old_password) == true) {
			//The old password is correct, continue with the process...
			//check if the confirm is same as the password...
			if ($confirm === $new_password) {
				//the confirm password is correct, continue with the process...
				require_once("functions/functions.php");
				updatePassword($new_password);
			}else{
				require_once("functions/alerts.php");
				alert_error("Your confirm password is incorrect!");
			}
		}else{
			//The old password is incorrect...
			require_once("functions/alerts.php");
			alert_error("Your old password is incorrect!");
		}
	}else{
		//There are errors, display them...
		foreach ($errors as $error) {
			require_once("functions/alerts.php");
			alert_error($error);
		}
	}

}

