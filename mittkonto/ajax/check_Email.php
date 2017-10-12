<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Email = $_GET['Email'];
echo check_Email($Email);
//This function checks if a user's new email is already in use
function check_Email($Email){


    $SQL          = "CALL read_email('". $Email ."')";
    $message_data = "SQL-ERROR AT mittkonto/ajax/check_Email.php FUNCTION check_Email()";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if(!$result){

        return '{"status": "Error"}';
    } 

    if($num_rows == 0){
    	return '{"status": "InUse"}';
    }

       return '{"status": "OK"}';
   
}