<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Category   = $_GET['Category'];
$city_state = $_GET['city_state']; 

echo get_citystate_offers($Category, $city_state);

function get_citystate_offers($Category, $city_state)
{
    $companies  = companies();
    $all_offers = read_offers();

    if($companies == 'Error' or $all_offers == 'Error'){
        return '{"status": "Error"}';
    }

    $offers = get_offers($companies, $all_offers, $city_state, $Category);

    if(count($offers) == 0){
      return '{"status": "no_offers"}';
    }
    $s = '{"status": "OK", "offer": [';
   
    for($i = 0; $i < count($offers); $i++){
        if($i > 0)
            $s .= ",";
        $s .= json_encode($offers[$i]);
        $arr[] = read_likes_length($offers[$i]['ID']);
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

function companies()
{
    $SQL = "CALL read_Companies()";
    $message = "SQL-ERROR at /kategorier/ajax/get_category_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
    $arr = array();
  
    if(!$result)
        return 'Error';
    while($row = $result->fetch_assoc()){
        $arr[] = $row;
    }
    return $arr;
}
function read_offers()
{
    $SQL = "CALL read_AllOffers()";
    $message = "SQL ERROR";
    $arr = array();
    list($num_rows, $res) = opendb($message, $SQL);
    if(!$res or $num_rows == 0) {
        return "Error";
    }
    
    while($row = $res->fetch_assoc()) {
        $arr[] = $row;
    }
    return $arr;
}
function get_offers($companies, $offers, $city_state, $Category)
{
    $arr    = array();
    $Offers = array();

    if($city_state == "-1" and $Category == "-1"){

         for($i = 0; $i < count($companies); $i++){

             $arr[] = $companies[$i]['ID'];
            
        }
    }

    if($city_state == "-1"){
        
        for($i = 0; $i < count($companies); $i++){
            
            if($companies[$i]['Category'] == $Category){
                $arr[] = $companies[$i]['ID'];
            }
            
        }
    }
        
    if($Category == "-1"){
    for($i = 0; $i < count($companies); $i++){

        if($companies[$i]['CityState'] == $city_state){
            $arr[] = $companies[$i]['ID'];
                }
    }

    }else{
        for($i = 0; $i < count($companies); $i++){
             
            if($companies[$i]['CityState'] == $city_state && $companies[$i]['Category'] == $Category){
                $arr[] = $companies[$i]['ID'];
            }
        }
        
    }

    for($i = 0; $i < count($offers); $i++){

        for($y = 0; $y < count($arr); $y++){
            if($offers[$i]['CompanyID'] == $arr[$y]){
                $Offers[] = $offers[$i];
            }
        }
    }

    return $Offers;
}
function read_likes_length($Offer)
{
    $SQL = "CALL read_likes_length('". $Offer ."')";
    $message = "SQL-ERROR at /kategorier/ajax/fetch_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
    return $num_rows;
}