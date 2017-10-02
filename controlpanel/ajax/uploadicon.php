<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

echo uploadIcon();


function uploadIcon()
{
    
    $file = uploadfile(FILETARGET, "iconfile");
    
    if ($file == "Error") {    
        return "Error";
    }
    
    if ($file == "ToBig") {
        return "ToBig";
    }
    
    if ($file == "NoExists") {
        return "NoExistsError";
    }
    
    $SQL          = "CALL read_company('" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/uploadicon.php function uploadIcon('" . $_SESSION['id'] . "')";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        return "ReadError";
    }
    
    
    $row = $result->fetch_assoc();
    
    unlink(FILETARGET . $row['Icon']);
    
    $SQL = "CALL update_CompanyIcon('" . $file . "','" . $_SESSION['id'] . "')";
    
    $message_data = "SQL-ERROR AT controlpanel/ajax/uploadbanner.php function uploadicon()";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if ($num_rows == 0 or !$result) {
        
        return "UpdateError";
    }
    
    return $file;
}
?>
