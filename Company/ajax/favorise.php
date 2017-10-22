<?php

@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Company = $_GET['company_id'];
$User    = $_SESSION['id'];

echo Favorise($Company, $User);

function Favorise($Company, $User){

    $SQL     = "CALL read_fav('". $User ."', '". $Company ."')";
    $message = "SQL-ERROR AT Company/ajax/favorise.php FUNCTION read_fav('". $User ."', '". $Company ."') ";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0){
        if(add($Company, $User) == 'Error')
            return '{"status": "Error"}';
        return '{"status": "OK"}'; 
    }

    if(rm($Company, $User) == "Error")
        return '{"status": "Error"}';
    return '{"status": "Removed_fav"}';

}

//Adds the company to favourites
function add($Company, $User){
    
    $SQL     = "CALL insert_favourite('". $User ."', '". $Company ."')";
    $message = "SQL-ERROR AT Company/ajax/favorise.php FUNCTION read_fav('". $User ."', '". $Company ."') ";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return 'Error';
    return 'OK';

}

//Removes the company to favourites
function rm($Company, $User){
    $SQL     = "CALL remove_fav('". $User ."', '". $Company ."')";
    $message = "SQL-ERROR AT Company/ajax/favorise.php FUNCTION read_fav('". $User ."', '". $Company ."') ";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0 or !$result)
        return 'Error';
    return 'OK';

}

