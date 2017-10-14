<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
$user_id = $_GET['user_id'];
echo get_favorites($user_id);
function get_favorites($user_id)
{
    $offers = get_offers($user_id);
    $arr = array();
    $alloffers = read_all_offers();
    $otheroffers = array();
    if($offers == "Error") {
        return '{"status" : "Error"}';
    }
     
    $s = '{"status": "OK", "favs": [';
    for($i = 0; $i < count($offers); $i++){
        $arr[] = read_likes_length($offers[$i]['ID']);
        if($i > 0)
            $s .= ",";
        for($y = 0; $y < count($alloffers); $y++){
            if($alloffers[$y]['ID'] != $offers[$i]['ID'])
                $otheroffers[] = $alloffers[$y];
        }
        $s .= json_encode($offers[$i]);
    }
    $s .= '],';
    $s .= '"likes": [';
    for($i = 0; $i < count($arr); $i++){
        if($i > 0)
            $s .= ",";
        $s .= json_encode($arr[$i]);
    }
   $s .= '],"OtherOffers": [';

   for($i = 0; $i < count($otheroffers); $i++){
       if($i > 0)
           $s .= ",";
       $s .= json_encode($otheroffers[$i]);
   }

   $s .= "]}";
    
    return $s;
}

function read_all_offers()
{
    $SQL = "CALL read_AllOffers()";
    $message = "SQL-ERROR at /kategorier/ajax/fetch_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
    $arr = array();
    
    if($num_rows == 0)
        return '{"status": "Done"}'; 
    
    if(!$result)
        return '{"status": "Error"}';
    while($row = $result->fetch_assoc()){
        $arr[] = $row;
    }
    return $arr;
}
function _get_favorites($user_id)
{
    $SQL = "CALL read_favs('" . $user_id . "')";
    $message = "SQL ERROR";
    $arr = array();
    list($num_rows, $res) = opendb($message, $SQL);
    if($num_rows == 0 or !$res) {
        return "Error";
    }
    
    while($row = $res->fetch_assoc()) {
        $arr[] = $row;
    }
    return $arr;
}
function get_offers($user_id)
{
    $message = "SQL ERROR";
    $arr = array();
    $user_favs = _get_favorites($user_id);
    for($i = 0; $i < count($user_favs); $i++){
         
        $SQL = "CALL read_offers('". $user_favs[$i]['CompanyID'] ."')";
        list($num_rows, $result) = opendb($message, $SQL);
        if($num_rows == 0 or !$result) {
            return "Error";
        }
          
        $row = $result->fetch_assoc();
        $likes = read_likes_length($row['ID']);
        $arr[] = $row;
     
    }
    return $arr;
}
function read_likes_length($Offer)
{
    $SQL = "CALL read_likes_length('". $Offer ."')";
    $message = "SQL-ERROR at /kategorier/ajax/fetch_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
    return $num_rows;
}