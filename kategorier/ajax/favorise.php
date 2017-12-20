<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$User    = $_GET['User'];
$Company = $_GET['Company'];

echo favorise($User, $Company);

function favorise($User, $Company)
{
    $checkFav = checkFav($User, $Company);

    if($checkFav == 'AlreadyExists')
        return '{"status": "AlreadyExists"}';

    $SQL     = "CALL insert_favourite('". $User ."', '". $Company ."')";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";

    list($affected_rows, $result) = opendb($message, $SQL);

    if($affected_rows == 0 or !$result)
        return '{"status": "Error"}';

    return '{"status": "OK", "Company": "'. $Company .'"}';
}

function checkFav($User, $Company)
{
    $SQL     = "CALL read_fav('". $User ."', '". $Company ."')";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return 'GO';
    return 'AlreadyExists';
}


