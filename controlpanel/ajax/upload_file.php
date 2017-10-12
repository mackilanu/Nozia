<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");


$caption = $_POST['Caption'];

echo uploadFile($caption);

function uploadFile($caption)
{

     $fileimage = uploadImage();

     if($fileimage == 'Error')
         return 'Error';

     $filepdf = uploadPdf();

    if($filepdf == 'Error')
        return 'Error';

    $result = add_file($filepdf, $caption, $fileimage);

    if($result == 'Error'){

        unlink(FILETARGET . $fileimage);
        unlink(FILETARGET . $filepdf);
        return 'Error';
    }

    return 'OK';
  
}

function uploadImage()
{
   
    $image = uploadfile(FILETARGET, "fileimg");
     
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

function add_file($filepdf, $caption, $fileimage)
{
    $SQL = "CALL insert_Company_file('". $_SESSION['id'] ."',  '". $filepdf ."', '". $fileimage ."', '". $caption ."')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/upload_background.php";

    list($num_rows, $result) = opendb($message_data, $SQL);

    if($num_rows == 0 or !$result)
     return 'Error';

    return 'OK'; 
}


?>
