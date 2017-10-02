<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$OfferID = $_GET['OfferID'];
echo remove_offer($OfferID);
//This function removes an offer.
function remove_offer($OfferID)
{
    
    $SQLread = "CALL read_offer('" . $OfferID . "')";
    
    
    $SQL          = "CALL update_Offer('" . $OfferID . "', '" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/remove_offer.php FUNCTION remove_offer($OfferID)";
    
    list($num_rowsread, $resultread) = opendb($message_data, $SQLread);
    
    if (!$resultread or $num_rowsread == 0) {
        return '{"status": "Error"}';
    }
    
    $row = $resultread->fetch_assoc();
    
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    unlink(FILETARGET . $row['Image']);
    
    return '{"status": "OK", "OfferID": "' . $OfferID . '"}';
    
}
