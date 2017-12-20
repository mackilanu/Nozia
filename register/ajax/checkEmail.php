<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

$email = $_GET['email'];
echo checkEmail($email);

// This function checks if the input email is already in use

function checkEmail($email)
{
	require_once ("../../MySQL/DBconnect.php");

	list($num_rows, $result) = opendb("", "CALL read_email('$email')");

	// If it is, the functions return OK.

	if ($num_rows == 0) {
		return '{"status": "OK"}';
	}
	else {
		return '{"status": "Exists"}';
	}
}

?>