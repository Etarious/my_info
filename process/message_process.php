<?php
require("../db/connection.php");
if (isset($_POST["message"]) || isset($_POST["visitor_id"])) {
	require_once("../functions/functions.php");
	if (empty(verifyVisitorInput($_POST["message"]))) {
		echo "Please type your instant-message";
	}

	$message = mysqli_real_escape_string($conn, verifyVisitorInput($_POST["message"]));
	$visitor_id = (int)$_POST["visitor_id"];

	//echo $visitor_id;
	//echo $message;

	require_once("../functions/functions.php");
	$result = sendMessage($message, $visitor_id);

	if ($result == false) {
		return false;
	}else{
		require_once("functions/alerts.php");
		alert_success("Message sent");
		return $result;
	}
	

}

