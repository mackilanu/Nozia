<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Category = $_GET['Category'];

echo get_category_offers($Category);

function get_category_offers($Category)
{
    $companies  = companies($Category);
    $all_offers = read_offers(); 

    $offers = get_offers($companies, $all_offers);

    if(count($offers) == 0)
        return '{"status": "no_offers"}';
     
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
    $SQL = "CALL read_category_companies('". $Category ."')";
    $message = "SQL-ERROR at /kategorier/ajax/get_category_offers.php";
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
function get_offers($companies, $offers)
{
    $arr = array();
    for($i = 0; $i < count($companies); $i++){

        for($y = 0; $y < count($offers); $y++){

            if($companies[$i]['ID'] == $offers[$y]['CompanyID']){
                $arr[] = $offers[$y];
            }
            
        }
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