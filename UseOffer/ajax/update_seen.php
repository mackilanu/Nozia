<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

require_once ("../../MySQL/DBconnect.php");

$User = $_GET['user_id'];
$Offer = $_GET['offer_id'];
echo update_seen($User, $Offer);

function update_seen($User, $Offer)
{
	$SQL = "CALL update_seen_offer('" . $User . "', '" . $Offer . "')";
	$message_data = "SQL-ERROR at UseOffer/ajax/Update_MyOffer.php FUNCTION uploadBanner($User, $Offer)";
	list($affected_rows, $result) = opendb($message_data, $SQL);
	if (!$result or $affected_rows == 0) {
		return '{"status": "Error"}';
	}

	return '{"status": "OK"}';
}

?>