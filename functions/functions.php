<?php

function verifyVisitorInput($input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}




function checkVisitorExists($email){
	require("db/connection.php");

	$query = "SELECT * FROM `visitors` WHERE `email` = '$email' LIMIT 1";
	$result = mysqli_query($conn, $query);

	//check if query ran...
	if ($result) {
		//check if any thing was found...
		if (mysqli_num_rows($result) == 1) {
			//visitor was found...
			return true;
		}else{
			//visitor was not found...
			return false;
		}
	}else{
		//there was an error...
		return false;
		require_once("functions/alerts.php");
		alert_error("There was an error: " . mysqli_error($conn));
	}
}




function registerVisitor($name, $email, $tel){
	//connect to the database...
	require("db/connection.php");

	//Validate email...
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		//email is not valid...
		require_once("functions/alerts.php");
		alert_warning("Email is invalid!");
	}else{
		//email is valid...
		if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $tel)) {
			//Tel is not valid...
			require_once("functions/alerts.php");
			alert_warning("Phone umber is invalid!");
		}else{
			//Tel is valid...
			$query = "INSERT INTO `visitors` (`name`, `email`, `tel`) VALUES ('$name', '$email', '$tel')";
			$result = mysqli_query($conn, $query);

			if ($result) {
				require_once("functions/alerts.php");
				alert_success("I am happy to know you!");
			}else{
				require_once("functions/alerts.php");
				alert_error("There was an error: " . mysqli_error($conn));
			}
		}
	}
	
}




function getVisitorId($email){
	//get the db...
	require("../db/connection.php");

	$id_query = "SELECT * FROM `visitors` WHERE `email` = '$email' LIMIT 1";
	$id_result = mysqli_query($conn, $id_query);

	if ($id_result) {
		if (mysqli_num_rows($id_result) == 1) {
			$array = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
			$visitor_id = $array['id'];
			return $visitor_id;
		}
	}else{
		require_once("functions/alerts.php");
		alert_error("There was an error: " . mysqli_error($conn));
	}
}




function sendMessage($message, $visitor_id){
	require("../db/connection.php");

	$message_query = "INSERT INTO messages (`message`, `date_created`, `visitors_id`, `deleted`) VALUES ('$message', NOW(), $visitor_id, 0)";
	$message_result = mysqli_query($conn, $message_query);

	if ($message_result) {
		//echo "working";
		return true;
	}else{
		return false;
	}

}




function setPassword($password){
	require("db/connection.php");

	if (strlen($password) >= 8) {
		//check if password has been set before...
		$check_query = "SELECT password FROM password LIMIT 1";
		$check_result = mysqli_query($conn, $check_query);

		if ($check_result) {
			if (mysqli_num_rows($check_result) == null) {
				//password has not been set before...
				//hash the password...
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				//insert the password to the db...
				$set_password_query = "INSERT INTO password (`password`) VALUES ('$hashed_password')";
				$set_password_result = mysqli_query($conn, $set_password_query);

				if ($set_password_result) {
					header("location: messages.php");
				}
			}else{
				//password has been set before...
				require_once("functions/alerts.php");
				alert_error("Password has been set before! But you can change your password.");
			}
		}
		
	}else{
		//Password is less than 8 characters...
		require_once("functions/alerts.php");
		alert_error("Password must be more than 8 characters!");
	}
	
}




function getHashedPassword(){
	require("db/connection.php");

	//get the hashed password...
	$hashed_query = "SELECT password FROM password LIMIT 1";
	$hashed_result = mysqli_query($conn, $hashed_query);

	if ($hashed_result) {
		if (mysqli_num_rows($hashed_result) == 1) {
			$array = mysqli_fetch_array($hashed_result, MYSQLI_ASSOC);
			$hashed_password = $array["password"];

			return $hashed_password;
		}
	}else{
		return false;
		require_once("functions/alerts.php");
		alert_error("Ther was an error: " . mysqli_error($conn));
	}
}




function checkPasswordCorrect($password){
	require("db/connection.php");

	//get the hashed password...
	$hashed_password = getHashedPassword();
	$verified_password = password_verify($password, $hashed_password);

	if ($verified_password) {
		//the password is correct...
		return true;
	}else{
		//password is in correct...
		return false;
	}
}




function updatePassword($password){
	require("db/connection.php");

	//hash the password...
	$password_hash = password_hash($password, PASSWORD_DEFAULT);

	//update it in the db...
	$query = "UPDATE password SET password = '$password_hash'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		//was updated successfully...
		require_once("functions/alerts.php");
		alert_success("Password changed successfully!");

		header("location: messages.php");
	}else{
		//there was an error...
		require_once("functions/alerts.php");
		alert_error("There was an error: " . mysqli_error($conn));
	}
}