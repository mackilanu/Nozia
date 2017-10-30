<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Color   = $_GET['Color'];
$ID      = $_GET['ID'];
echo update_NavbarColor($Color, $ID);

function update_NavbarColor($Color, $ID)
{  
    $SQL = "CALL update_NavbarColor('". $ID ."', '". $Color ."')";
    $message = "SQL ERROR AT controlpanel/update_navbar.php FUNCTION update_BackgroundColor($Color)";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result){
       return '{"status": "Error"}';
    }

   return '{"status": "OK"}';
}

?>