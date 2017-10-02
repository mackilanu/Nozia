<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../includes/fileupload.php");

$Caption     = $_POST['txt_Caption'];
$Description = $_POST['txt_Description'];
$StartDate   = $_POST['txt_StartDate'];
$DueDate     = $_POST['txt_DueDate'];
$FromAge     = $_POST['txt_MinAge'];
$ToAge       = $_POST['txt_MaxAge'];
$Gender      = $_POST['txt_Gender'];
$latest      = '1';
$CS          = $_POST['selectCS'];

print_r($CS);

echo uploadBanner($Caption, $Description, $StartDate, $DueDate, $FromAge, $ToAge, $latest, $Gender, $CS);

function uploadBanner($Caption, $Description, $StartDate, $DueDate, $FromAge, $ToAge, $latest, $Gender, $CS)
{
    
    
    //==================
    //Insert the offer
    //==================
    
    $image = uploadfile(FILETARGET, "newOffer_file");
    
    $SQL = "CALL insert_Offer('" . $Caption . "', 
                             '" . $image . "',
                             '" . $Description . "',
                             '" . $StartDate . "',
                             '" . $DueDate . "',
                             '" . $_SESSION['id'] . "',
                             '" . $FromAge . "',
                             '" . $ToAge . "',
                             '" . $latest . "',
                             '" . $Gender . "')";
    
    $message_data = "SQL-ERROR at controlpanel/ajax/uploadoffer.php FUNCTION uploadBanner($Caption, $Description, $StartDate, $DueDate, $FromAge, $ToAge, $latest, $Gender)";
    
    list($affected_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $affected_rows == 0) 
        return 'Error';
    
    
    $SQL = "CALL read_offerWithParams('" . $_SESSION['id'] . "', '" . $Caption . "')";
    
    list($affected_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $affected_rows == 0) 
        return 'Error';
    
    
    //==================
    //Insert all CityStates associated with the offer.
    //==================
    
    $row = $result->fetch_assoc();
    
    
    $length = count($CS);
    
    
    for ($i = 0; $i < $length; $i++) {    
        $SQL = "CALL insertOfferCS('" . $CS[$i] . "', '" . $row['ID'] . "')";
        
        list($affected_rows, $result) = opendb($message_data, $SQL);      
    }
    
    if (!$result or $affected_rows == 0) {
        return 'Error';
    }
    
    //==================
    //Insert to Myoffers associated with the offer and all the users.
    //==================
    
    $SQL = "CALL read_Users()";
    
    list($affected_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $affected_rows == 0) 
        return 'Error';
    
    
    while ($rows = $result->fetch_assoc()) {
        
        $SQL = "CALL insert_MyOffer('" . $rows['ID'] . "', '" . $row['ID'] . "')";
        
        list($num_rows, $resultInsert) = opendb($message_data, $SQL);
        
        if (!$result or $num_rows == 0) 
            return 'Error';
        
        
    }
    return 'Ok'; 
}
?>
