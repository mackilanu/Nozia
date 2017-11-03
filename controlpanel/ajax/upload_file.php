<?php
@session_start();


date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

$caption = $_POST['Caption'];

echo upload($caption);

function upload($caption)
{
    $read_length = read_length();

    if($read_length > 2)
        return "Max";
    
    $filepdf = uploadPdf();
    if($filepdf == 'Error')
        return 'Error';
    
    $result = add_file($filepdf, $caption);

    if($result == 'Error'){
        unlink(FILETARGET . $filepdf);
        return 'Error';
    }

    return 'OK';  
}

function read_length() {

    $SQL     = "CALL read_company_files('". $_SESSION['id']."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/upload_background.php";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if(!$result)
        return 'Error';

    return $num_rows; 
}

function uploadPdf()
{
    $image = uploadfile(FILETARGET, "filepdf");
     
    if ($image == "Error") {    
        return "Error";
    }
    
    if ($image == "ToBig") {
        return "Error";
    }
    
    if ($image == "NoExists") {
        return "Error";
    }

    return $image;
}

function add_file($filepdf, $caption)
{
    $SQL = "CALL insert_Company_file('". $_SESSION['id'] ."',  '". $filepdf ."', '". $caption ."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/upload_background.php";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if($num_rows == 0 or !$result)
     return 'Error';

    return 'OK'; 
}


?>
