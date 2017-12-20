<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$string = $_GET['Vid'];

echo checkVerified($string);
//This function checks if the input Username and Password is correct
function checkVerified($string){


    $SQL = "CALL read_verify('". $string ."')";
    $message = "SQL ERROR AT checkVerified($string) ";
    list($num_rows, $result) = opendb($message, $SQL);
     
    //If the login is valid $num_rows will return 1

    $row = $result->fetch_assoc();

    if($num_rows == 0){

        return '{"status": "NoExists"}';
    }

    if($row['verify'] == 1){
       return '{"status": "Already"}';
    }
 

    $SQL = "CALL update_verifyUser('". $string ."')";
    $message = "SQL ERROR AT checkVerified($string) ";
    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0){
         return '{"status": "OK"}';
    }




    return '{"status": "OK"}'; 
}