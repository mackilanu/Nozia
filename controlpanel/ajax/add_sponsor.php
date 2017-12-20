<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

$Title = $_POST["txt_Title"];
$URL   = $_POST["txt_URL"];

echo addsponsor($Title, $URL);

function addsponsor($Title, $URL)
{
    
    $file = uploadfile(FILETARGET, "txt_Image");
    
    if ($file == "Error") {
        
        return "FileError";
    }
    
    if ($file == "ToBig") {
        return "ToBig";
    }
    
    if ($file == "NoExists") {
        return "ErrorFileNotExists";
    }
    
    $SQL          = "CALL add_sponsor('". $Title ."', '". $file ."', '". $URL ."','" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/add_sponsor.php function addsponsor($Title, $URL)";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        return "Error";
    }
    

    return "OK";    
}
?>
