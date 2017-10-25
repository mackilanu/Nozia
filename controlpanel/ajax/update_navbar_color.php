<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$color  = $_GET['Color'];
echo change_navbar_color($color);
//This function updates the company's navbar color.
function change_navbar_color($color)
{
    $SQL          = "CALL update_NavbarColor('" . $_SESSION['id']  . "', '" . $color . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/update_navbar_color.php FUNCTION update_NavbarColor";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';
    
}