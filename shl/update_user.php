<?php

@session_start();

if (!isset($_SESSION['JerseyNo'])){
    header('Location: nosession.php');
    exit;
}


header("Content-type: text/html; charset=utf-8");

date_default_timezone_set("Europe/Stockholm");

$JNO = $_GET['JNO'];

require_once("includes/config.php");
require_once("includes/io.php");
require_once("includes/opendb.php");



echo DOCTYPEN . '<title>Användarkonton</title>' . RESTEN;

echo BODY;

echo FOTEN;
require_once("includes/parametrar.php");


require_once("includes/loginfo.php"); // Fixar inloggningsuppgifterna


// Fixar menyn
echo '<script type="text/javascript">';
echo "var Userslista  = '';";
echo "Userslista      = JSON.parse( '" . read_user($JNO)   . "' );";
echo "</script>";

// Tillhörande JavaScript-filer
echo '<script type="text/javascript" src="javascript/common.js"></script>';
echo '<script type="text/javascript" src="javascript/update_user.js"></script>';


echo AVSLUT;



function read_user($JNO){

    $message_data = "SHL-ERROR vid change_user.php function read_user($JNO).";

    $SQL  = "CALL read_user($JNO)";

    
    list($affected_rows,$result) = opendb($message_data,$SQL);


    if (!$result or $affected_rows == 0){
        return '{"status": "Error"}';
    }


    $Userslista = '{"status": "OK", "User": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Userslista .=  ',';
        }
        $Userslista     .=  json_encode($row);
    }
    $Userslista         .= ']}';

    
    return $Userslista;

}

?>
