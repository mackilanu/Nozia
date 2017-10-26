<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$ID = $_GET['CompanyID'];

echo get_background($ID);

function get_background($ID)
{
    $SQL     = "CALL read_CompanyBg('". $ID ."')";
    $message = "SQL-ERROR AT controlpanel/ajax/get_files.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result or $num_rows == 0)
        return '{"status": "Error"}';

    $row = $result->fetch_row();

    if($row[0] == null)
    return '{"status": "NoBg"}';

    return '{"status": "OK", "color": "'. $row[0] .'"}';  


}
?>
