<?php

if (isset($_POST['m_id'])) {
	require("../db/connection.php");

	$id = $_POST['m_id'];

	//echo $id;

	$id_query = "UPDATE messages SET `deleted` = '1' WHERE `m-id` = $id";
	$id_result = mysqli_query($conn, $id_query);

	if ($id_result) {
		return true;
	}else{
		require_once("../functions/alerts.php");
		return alert_error("There was an error: " . mysqli_error($conn));
		//return false;
	}
}else{
	return "m_id not set";
}


