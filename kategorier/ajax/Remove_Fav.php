<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$User    = $_GET['User'];
$Company = $_GET['Company'];

echo RemoveFav($User, $Company);

function RemoveFav($User, $Company)
{
    $SQL     = "CALL remove_fav('". $User ."', '". $Company ."')";
    $message = "SQL ERROR AT /kategorier/ajax/Remove_Fav.php";

    list($num_rows, $result) = opendb($message, $SQL);

    
    if($num_rows == 0 or !$result)
        return '{"status": "Error"}';
        

    return '{"status": "OK"}';

}


