<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Pw = $_GET['currentPw'];
echo check_pw($Pw);
//This function updates the company's information
function check_pw($Pw){

    $Hashedpw = hash('sha256', $Pw);

    $SQL          = "CALL read_UserPw('". $Hashedpw ."', '". $_SESSION['id'] ."')";
    $message_data = "SQL-ERROR AT mittkonto/ajax/check_currentPw.php FUNCTION check_pw()";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if(!$result){

        return '{"status": "Error"}';
    } 

    if($num_rows == 0){
    	return '{"status": "WrongPw"}';
    }

       return '{"status": "OK"}';
   
}