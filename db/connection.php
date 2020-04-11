<?php
//connect to the database...
$host = "localhost";
$user = "etaoghen_my_info";
$pass = "Am Heaven Bound";
$db = "etaoghen_my_info";

$conn = mysqli_connect($host, $user, $pass, $db) or die("Couldn't connect to the database");


if ($conn) {
	//automatically creating the table...
	$query = "CREATE TABLE IF NOT EXISTS `visitors` (
		id INT 	PRIMARY KEY AUTO_INCREMENT,
		name VARCHAR(64) NOT NULL,
		email VARCHAR(64) NOT NULL,
		tel VARCHAR(15) NOT NULL
	)";

	$result = mysqli_query($conn, $query);




	$message_query = "CREATE TABLE IF NOT EXISTS `messages` (
		`m-id` int PRIMARY KEY AUTO_INCREMENT,
		`message` text NOT NULL,
		`date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
		`visitors_id` int(11) NOT NULL,
		`deleted` int(11) NOT NULL DEFAULT 0
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

	$message_result = mysqli_query($conn, $message_query);




	$password_query = "CREATE TABLE IF NOT EXISTS `password` (
		`password` VARCHAR(64) NOT NULL
	)";

	$password_result = mysqli_query($conn, $password_query);
}

