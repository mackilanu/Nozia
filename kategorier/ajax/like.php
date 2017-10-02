<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$User    = $_GET['User'];
$Offer   = $_GET['Offer'];
$Company = $_GET['Company'];

echo like($User, $Offer, $Company);

function like($User, $Offer, $Company)
{
    $check = checkLike($User, $Offer, $Company);
    $remove = 'No';

    if($check == 'Error')
        return '{"status": "Error"}';
    //Ska ta bort gillningen om man redan har gillat.
    if($check == 'AlreadyLiked')
      $remove =  removeLike($User, $Offer, $Company);
  
    if($remove != 'No'){
        if($remove == 'Error')
            return '{"status": "Error"}';

        return '{"status": "OK", "type": "remove", "Offer": "'. $Offer .'"}';
  }

    $SQL     = "CALL insert_like('". $User ."', '". $Offer ."' , '". $Company ."')";
    $message = "SQL ERROR AT /kategorier/ajax/like.php"; 
    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0 or !$result)
        return '{"status": "Error"}';
    
    return '{"status": "OK", "Offer": "'. $Offer .'", "type": "add"}';
}

function checkLike($User, $Offer, $Company)
{

    $SQL = "CALL read_like('". $User ."', '". $Offer ."' , '". $Company ."')";
    $message = "SQL ERROR AT /kategorier/ajax/like.php"; 
    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result)
        return 'Error';

    if($num_rows == 0)
        return 'Ok';

    return 'AlreadyLiked';
}

function removeLike($User, $Offer, $Company)
{
     $SQL = "CALL remove_like('". $User ."', '". $Offer ."' , '". $Company ."')";
     $message = "SQL ERROR AT /kategorier/ajax/like.php"; 
     list($num_rows, $result) = opendb($message, $SQL);

     if($num_rows == 0 or !$result)
        return 'Error';

    return 'Ok';
}
?>
