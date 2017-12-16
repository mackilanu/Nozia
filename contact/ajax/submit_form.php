<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

$Name    = $_GET['name'];
$Email   = $_GET['email'];
$Subject = $_GET['subject'];
$Message = $_GET['message'];
$User    = $_SESSION['id'];

echo submit_form($Name, $Email, $Subject, $Message, $User);

function submit_form($Name, $Email, $Subject, $Message, $User)
{
    
    $SQL          = "CALL insert_contact('". $Name ."', '". $Email ."', '". $Subject ."','" . $Message . "', '". $User ."')";
    $message_data = "SQL-ERROR AT contact/ajax/submit_form.php function submit_form($Name, $Email, $Subject, $Message, $User)";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';    
}
?>
