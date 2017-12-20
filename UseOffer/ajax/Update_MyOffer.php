
<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

require_once ("../../MySQL/DBconnect.php");

$User = $_GET['User'];
$Offer = $_GET['Offer'];
echo Update_MyOffer($User, $Offer);

function Update_MyOffer($User, $Offer)
{

	// ==================
	// Update MyOffer
	// ==================

	$SQL = "CALL update_MyOffer('" . $User . "', '" . $Offer . "')";
	$message_data = "SQL-ERROR at UseOffer/ajax/Update_MyOffer.php FUNCTION uploadBanner($User, $Offer)";
	list($affected_rows, $result) = opendb($message_data, $SQL);
	if (!$result or $affected_rows == 0) {
		return '{"status": "Error"}';
	}

	return '{"status": "OK"}';
}

?>