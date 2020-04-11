<?php


require("../db/connection.php");

$query = "SELECT visitors.`id`, visitors.`name`, visitors.`email`, visitors.`tel`, messages.`message`, messages.`date_created`, message`visitors_id`, messages.`m-id` FROM visitors LEFT JOIN messages ON visitors.id = messages.visitors_id WHERE messages.deleted = 0";
$result = mysqli_query($conn, $query);

//echo "<pre>";
//print_r($result);
if ($result) {
	
	if (mysqli_num_rows($result) > 0) {
		$message_array = [];
		while ($array = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$message_array[] = $array["id"] ."/". $array["message"] ."/". $array["date_created"] ."/". $array["name"] ."/". $array["email"] ."/". $array["tel"] ."/". $array["m-id"];
		}
		
		//return print_r($result);
		echo json_encode($message_array);
	}else{
		require_once("functions/alerts.php");
		alert_warning("No messages");
		return false;
	}
}else{
	return "there was an error.";
}


