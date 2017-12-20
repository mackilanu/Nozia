<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Color   = $_GET['Color'];
$ID      = $_GET['ID'];
echo update_BackgroundColor($Color, $ID);
//This function updates the company's miniblog
function update_BackgroundColor($Color, $ID)
{  
    $SQL = "CALL update_BackgroundColor('". $Color ."', '". $ID ."')";
    $message = "SQL ERROR AT controlpanel/update_BackgroundColor.php FUNCTION update_BackgroundColor($Color)";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result){
       return '{"status": "Error"}';
    }

   return '{"status": "OK"}';
}

?>