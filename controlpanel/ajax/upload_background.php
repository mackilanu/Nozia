<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

echo uploadBackground();

function uploadBackground()
{

    $read_current = read_current_bg();

    if($read_current == "Error")
        return 'Error';

    if($read_current != "NoBg")
        unlink(FILETARGET . $read_current);


  
    
    $image = uploadfile(FILETARGET, "bgfile");

      
    if ($image == "Error") {    
        return "Error";
    }
    
    if ($image == "ToBig") {
        return "ToBig";
    }
    
    if ($image == "NoExists") {
        return "NoExistsError";
    }


     
    $SQL = "CALL update_CompanyBackground('". $image ."', '".  $_SESSION['id']."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/upload_background.php";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if($num_rows == 0 or !$result)
     return 'Error';

    return 'OK'; 
}

function read_current_bg(){

    $SQL     = "CALL read_CompanyBg('". $_SESSION['id'] ."')";
    $message = "SQL-ERROR AT controlpanel/ajax/get_files.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result or $num_rows == 0)
        return 'Error';

    $row = $result->fetch_row();

    if($row[0] == null)
    return 'NoBg';

    return $row[0];
}
?>
