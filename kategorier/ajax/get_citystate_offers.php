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
    $companies  = companies($Category);
    $all_offers = read_offers();

    if($companies == 'Error' or $all_offers == 'Error'){
        return '{"status": "Error"}';
    }

    $offers = get_offers($companies, $all_offers, $city_state, $Category);

    if($offers == 'NoOffers'){
        return '{"status": "NoOffers"}';
    }
    if($offers == "Error")
         return '{"status": "Error"}';
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

function companies($Category)
{
    $SQL = "";

    if($Category == "-1"){
    $SQL = "CALL read_Companies()";
    }else{
        $SQL = "CALL read_category_companies('". $Category ."')";
    }
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
    $Companies = array();
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
    $rest_offers = array();
    $Offerss = array();
    
    if($city_state == "-1" and $Category == "-1"){

         for($i = 0; $i < count($companies); $i++){

             $arr[] = $companies[$i];
            
        }
    }

    if($city_state == "-1"){
        
        for($i = 0; $i < count($companies); $i++){
            
            if($companies[$i]['Category'] == $Category){
                $arr[] = $companies[$i];
            }
            
        }
    }else{
        $rest_offers = get_rest_offers($city_state, $Category, $offers, $companies);
        if($res_offers == 'NoOffers')
            return 'NoOffers';
    }

        if($rest_offers == "Error")
            return 'Error';
        
    if($Category == "-1"){
    for($i = 0; $i < count($companies); $i++){

        if($companies[$i]['CityState'] == $city_state){
            $arr[] = $companies[$i];
                }
    }

    }else{
        for($i = 0; $i < count($companies); $i++){
             
            if($companies[$i]['CityState'] == $city_state && $companies[$i]['Category'] == $Category){
                $arr[] = $companies[$i];
            }
        }
        
    }

    for($i = 0; $i < count($offers); $i++){

        for($y = 0; $y < count($arr); $y++){
            if($offers[$i]['CompanyID'] == $arr[$y]['ID']){
                $Offers[] = $offers[$i];
            }
        }
    }

    if(count($rest_offers) > 0){

        for($i = 0; $i < count($rest_offers); $i++){
            for($y = 0; $y < count($offers); $y++)
                if($rest_offers[$i]['Offer'] == $offers[$y]['ID'])
                    $Offerss[] = $offers[$y];
        }
                
        
         for($i = 0; $i < count($Offerss); $i++){
             $Offers[] = $Offerss[$i];
         }

         
         $Offers = array_unique($Offers, SORT_REGULAR);
         $Offers = array_values($Offers);

         return $Offers;
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

function get_rest_offers($city_state, $Category, $offers, $companies){
    
    if($Category == '-1')
        $SQL = "CALL read_Offer_CS('". $city_state ."')";
    else
        $SQL = "CALL read_Offer_CSParam('". $city_state ."', '". $Category ."')";
    
    $message = "SQL-ERROR at /kategorier/ajax/get_Categoy_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
    
    if(!$result)
        return 'Error';
    
    if($num_rows == 0)
        return 'NoOffers';
    
    $arr = array();
  
    while($row = $result->fetch_assoc()){
        $arr[] = $row;
    }

    if($Category == '-1')
        return $arr;


    return $arr;
}
    
