<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
$user_id = $_GET['user_id'];
$all_offers = read_all_offers();
echo get_favorites($user_id);
function get_favorites($user_id)
{
    $offers = get_offers($user_id);
    
    if($offers == 'no_favs')
        return '{"status": "no_favs"}';
    
    
    $arr = array();
    $alloffers = read_all_offers();
    $testarr = array();
    $testarr2 = array();
    for($y = 0; $y < count($offers); $y++){
        $testarr[] = $offers[$y];
    }
    for($i = 0; $i < count($alloffers); $i++){
        $testarr[] = $alloffers[$i];
    }


    $testarr = array_unique($testarr, SORT_REGULAR);
    $testarr = array_values($testarr);

  
    if($offers == "Error") {
        return '{"status" : "Error"}';
    }

     
    $s = '{"status": "OK", "favs": [';
   
    for($i = 0; $i < count($testarr); $i++){
        if($i > 0)
            $s .= ",";
        $s .= json_encode($testarr[$i]);
        $arr[] = read_likes_length($testarr[$i]['ID']);
    }
    $s .= '],';
    $s .= '"likes": [';
    for($i = 0; $i < count($arr); $i++){
        if($i > 0)
            $s .= ",";
        $s .= json_encode($arr[$i]);
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
    if(!$res) {
        return "Error";
    }

    if($num_rows == 0)
        return 'no_favs';
    
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

    if($user_favs == 'no_favs')
        return 'no_favs';
        
    for($i = 0; $i < count($user_favs); $i++){
         
        $SQL = "CALL read_offers('". $user_favs[$i]['CompanyID'] ."')";
        list($num_rows, $result) = opendb($message, $SQL);
        
        if($num_rows == 0){
            return 'no_favs';
        }
         
        if(!$result) {
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