<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$User    = $_GET['User'];

echo readFavs($User);

function readFavs($User)
{
    $SQL     = "CALL read_favs('". $User ."')";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return '{"status": "NoSubs"}';
    if(!$result)
        return '{"status": "Error"}';

    $subs = '{"status": "OK", "subs": [';
    for ($i = 0; $i < $num_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $subs .=  ',';
        }
        $subs     .=  json_encode($row);
    }
    $subs         .= ']}';

  return $subs;


}


