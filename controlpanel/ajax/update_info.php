<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$email  = $_GET['Email'];
$phone  = $_GET['Phone'];
$adress = $_GET['Adress'];
echo update_info($email, $phone, $adress);
//This function updates the company's information
function update_info($email, $phone, $adress)
{
    $SQL          = "CALL update_foretagssida('" . $phone . "', '" . $adress . "', '" . $email . "', '" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/update_info.php FUNCTION update_info()";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';
    
}