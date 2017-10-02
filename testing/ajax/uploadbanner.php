<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

echo uploadBanner();

function uploadBanner()
{
    
    $file = uploadfile(FILETARGET, "file");
    
    if ($file == "Error") {
        
        return "Error";
    }
    
    if ($file == "ToBig") {
        return "ToBig";
    }
    
    if ($file == "NoExists") {
        return "Error";
    }
    
    $SQL          = "CALL read_Foretagssida('" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/uploadbanner.php function uploadbanner()";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        return "ReadError";
    }
    
    $row = $result->fetch_assoc();
    
    unlink(FILETARGET . $row['Banner']);
    
    $SQL = "CALL update_banner('" . $file . "','" . $_SESSION['id'] . "')";
    
    $message_data = "SQL-ERROR AT controlpanel/ajax/uploadbanner.php function uploadbanner()";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if ($num_rows == 0 or !$result) {
        
        return "UpdateError";
    }
    
    return $file;
    
    
    
}
?>
