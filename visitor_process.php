<?php

if (isset($_POST["send_message"])) {
	require("db/connection.php");

	//verify inputs...
	require_once("functions/functions.php");
	$errors = [];

	if (empty(verifyVisitorInput($_POST["name"]))) {
		$errors[] = "please input your name";
	}
	if (empty(verifyVisitorInput($_POST["email"]))) {
		$errors[] = "Please input your email";
	}
	if (empty(verifyVisitorInput($_POST["tel"]))) {
		$errors[] = "Please input your Phone Number";
	}
	

	//check if there are any errors...
	if (empty($errors)) {
		//There are no errors...
		$name = ucfirst(mysqli_real_escape_string($conn, verifyVisitorInput($_POST["name"])));
		$email = strtolower(mysqli_real_escape_string($conn, verifyVisitorInput($_POST["email"])));
		$tel = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["tel"]));
		//$message = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["message"]));

		//check if visitor exists...
		require_once("functions/functions.php");
		if (checkVisitorExists($email) == false) {
			//visitor does not exist...
			//register the visitor...
			require_once("functions/functions.php");
			registerVisitor($name, $email, $tel);

			require_once("functions/alerts.php");
			alert_success("Thank you for sending us an Instant-Message for the first time. Please fill the form and send your message again");
		}
	}else{
		//There are errors...
		foreach ($errors as $error) {
			require_once("functions/alerts.php");
			alert_error($error);
		}
	}


}



/*if (isset($_POST["message"]) && isset($_POST["visitor_id"])) {
	//require the db...
	require("db/connection.php");

	$message = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["message"]));
	$visitor_id = (int)$_POST["visitor_id"];

	require_once("functions/functions.php");
	if (sendMessage($message, $visitor_id) == true) {
		//message was sent...
		require_once("functions/alerts.php");
		alert_success("Message sent");
	}

}*/
