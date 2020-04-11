<?php

if (isset($_POST["submit_password"])) {
	require("db/connection.php");

	require_once("functions/functions.php");
	if (empty(verifyVisitorInput($_POST["password"]))) {
		require_once("functions/alerts.php");
		alert_error("Please enter password");
	}else{
		$password = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["password"]));

		require_once("functions/functions.php");
		if (checkPasswordCorrect($password) == true) {
			//the password is correct...
			$html = "<span id='r_button'>The password is correct. <button class='btn btn-md btn-success' onclick='retrieveMessages()' name='retrieve'>Retrieve Messages</button></span>";
			echo $html;
			
		}else{
			//the password is incorrect...
			require_once("functions/alerts.php");
			alert_error("Password is incorrect!");
		}
	}
}