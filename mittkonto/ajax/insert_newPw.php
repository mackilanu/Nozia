<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Pw = $_GET['newPw'];
echo insert_Pw($Pw);
//This function updates the company's information
function insert_Pw($Pw){

    $Hashedpw = hash('sha256', $Pw);

    $SQL          = "CALL update_Pw('". $Hashedpw ."', '". $_SESSION['id'] ."')";
    $message_data = "SQL-ERROR AT mittkonto/ajax/check_currentPw.php FUNCTION check_pw()";

    list($num_rows, $result) = opendb($message_data, $SQL);

   
   if(!$result or $num_rows == 0){
    return '{"status": "Error"}';
   }

       return '{"status": "OK"}';
    
   
}