<?php
require_once("../db/connection.php");
if (isset($_POST['email'])) {
	require_once("../functions/functions.php");
	$email = strtolower(mysqli_real_escape_string($conn, verifyVisitorInput($_POST["email"])));

	require_once("../functions/functions.php");

	$visitor_id = getVisitorId($email);

	echo $visitor_id;

	return $visitor_id;
}

