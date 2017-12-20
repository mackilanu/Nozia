<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Email = $_GET['Email'];
echo update_Email($Email);
//This function checks if a user's new email is already in use
function update_Email($Email){


    $SQL          = "CALL update_Email('". $Email ."', '". $_SESSION['id'] ."')";
    $message_data = "SQL-ERROR AT mittkonto/ajax/check_Email.php FUNCTION check_Email()";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if($num_rows == 0 or !$result){

        return '{"status": "Error"}';
    } 


       return '{"status": "OK"}';
   
}
