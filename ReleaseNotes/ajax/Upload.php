<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Caption  = $_GET['Caption'];
$Message  = $_GET['Message'];
$date     = $_GET['Date'];
$Version  = $_GET['Version'];

echo insert_patch($Caption, $Message, $date, $Version);

function insert_patch($Caption, $Message, $date, $Version){

    $SQL          = "CALL 	insert_patchnote('". $Caption ."', '". $Message ."', '". $date ."', '". $Version ."')";
    $message_data = "SQL-ERROR AT ReleaseNotes/ajax/update_Post.php FUNCTION uinsert_patch($Caption, $Message, $date, $Version)";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if(!$result or $num_rows == 0){

        return '{"status": "Error"}';
    } 

       return '{"status": "OK"}';
   
}