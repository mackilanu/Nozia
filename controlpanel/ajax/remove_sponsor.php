<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$ID  = $_GET['ID'];

echo remove_sponsor($ID);

function remove_sponsor($ID)
{
    $SQL          = "CALL remove_sponsor('". $ID ."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/remove_sponsor.php FUNCTION remove_sponsor($ID)";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';
    
}