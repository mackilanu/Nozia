<?php

header("Content-type: text/html; charset=utf-8");

@session_start();

if (!isset($_SESSION['JerseyNo'])){
    header("Location: ../nosession.php");
    exit();
}



date_default_timezone_set("Europe/Stockholm");

require_once("../includes/config.php");
require_once("../includes/io.php");
require_once("../includes/opendb.php");


$GameId    = $_GET['GameId'];
$Publicera = $_GET['Publicera'];


echo setPublicera($GameId,$Publicera);





function setPublicera($GameId,$Publicera){
    $message_data = "SHL-ERROR vid ajax/set_publicera.php function setPublicera($GameId,$Publicera)";

    $Season = $_SESSION['Season'];

    $SQL = "CALL update_PubliceraMatch($Season, $GameId, ";
    if ($Publicera == 'J'){
        $SQL .= "'$Publicera')";
    } else {
        $SQL .= 'NULL)';
    }


    list($affected_rows,$result)  = opendb($message_data,$SQL);
    if (!$result) return '{"status": "Error"}';

    return '{"status": "OK"}';
}

?>
