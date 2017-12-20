<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$ID  = $_GET['ID'];

echo delete_file($ID);
//This function updates the company's information
function delete_file($ID)
{
    $SQL          = "CALL delete_file('". $ID ."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/update_info.php FUNCTION update_info()";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';
    
}