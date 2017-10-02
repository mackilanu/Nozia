<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$CS = $_GET['CS'];
echo check_offer_cs($CS);
//This function updates the company's information
function check_offer_cs($CS){

    $SQL          = "CALL read_Offer_CS('". $CS ."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/update_info.php FUNCTION update_info()";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if(!$result or $num_rows == 0){

        return '{"status": "Error"}';
    } 

    $OfferCS = '{"status": "OK", "OfferCS": [';
    for ($i = 0; $i < $num_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $OfferCS .=  ',';
        }
        $OfferCS     .=  json_encode($row);
    }
    $OfferCS        .= ']}';

    return $OfferCS;
}