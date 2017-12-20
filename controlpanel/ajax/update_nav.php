<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Color = $_GET['Color'];
$ID   = $_SESSION['id'];

echo update_navbar_color($Color, $ID);

function update_navbar_color($Color, $ID)
{
    $SQL = "CALL update_NavbarColor('". $ID ."', '". $Color ."')";

    $message = "Error";

    list($num_row, $result) = opendb($message, $SQL);

    if($num_rows == 0; or !$result){
        return '{"status": "Error"}';
    }

     return '{"status": "OK"}';
}
