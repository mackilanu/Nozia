
<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

$username = $_GET['username'];
echo checkUsername($username);

// This function checks if the input username is already in use

function checkUsername($username)
{
	require_once ("../../MySQL/DBconnect.php");

	list($num_rows, $result) = opendb("", "CALL read_usernames('$username')");

	// If it is, the functions return OK.

	if ($num_rows == 0) {
		return '{"status": "OK"}';
	}
	else {
		return '{"status": "Exists"}';
	}
}