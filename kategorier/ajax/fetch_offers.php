<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");


$OnlyFavs = $_GET['OnlyFavs'];

if($OnlyFavs == "Yes"){
$favs =  read_favs();

if($favs == 'Error'){
    echo '{"status": "Error"}';
    return;
}

if($favs == "NoSubs"){
    echo '{"status": "NoSubs"}';
    return;
}
echo fetch_offers($favs, $OnlyFavs);


//&$companies = read_companies();
 //echo read_fav_companies($favs, $companies, $favs);
}
//How many rows per page that should be fetched from the databse

if($OnlyFavs == "No")
 echo fetch_offers( "", $OnlyFavs);

function fetch_offers($favs, $OnlyFavs)
{
 
    $SQL = "CALL read_AllOffers()";
    $message = "SQL-ERROR at /kategorier/ajax/fetch_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);
      
        if($num_rows == 0)
        return '{"status": "Done"}'; 

    if(!$result)
        return '{"status": "Error"}';

      
    
    $SQL     = "CALL read_CompanyUsernames()";
    list($affected_rows, $resultNames) = opendb($message, $SQL);
    $arr = array();
  
    $name;
    while($rows = $resultNames->fetch_row()){
        $arr[] = $rows;
    }
        
    
    
    $Offers = '{"status": "OK",  "offer": [';
    for ($i = 0; $i < $num_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        if ($i > 0) {
            $Offers .= ',';
        }
        if ($i > 0) {
                 $likes.= ',';
             }
             $likes .= read_likes_length($row['ID']);
           
           if($OnlyFavs == "Yes"){
               for($y = 0; $y < count($favs); $y++){
               
               if($favs[$y]['CompanyID'] != $row['CompanyID'])
                   $Offers .= json_encode($row);
           
               }
}else{
    $Offers .= json_encode($row);
}
    }
    $Offers .= '] , "likes": ["'. $likes .'"]}';

    return $Offers; 
}

function read_fav_companies($favs, $companies){
    $arr = array();


 $s = '{"status": "OK",  "companies": [';
    for($i = 0; $i < count($companies); $i++){
         
        for($y = 0; $y < count($favs); $y++){

            if($favs[$i]['CompanyID'] == $companies[$y]['CompanyID']){
              if($i > 0)
                $s .= ",";
               $s .= json_encode($companies[$y]);
            }
        }
    }
$s .= "]}";

 return $s;

}

 

function read_likes_length($Offer)
{
    $SQL = "CALL read_likes_length('". $Offer ."')";
    $message = "SQL-ERROR at /kategorier/ajax/fetch_offers.php";
    list($num_rows, $result) = opendb($message, $SQL);

    return $num_rows;

}

function read_companies()
{
    $SQL = "CALL read_AllOffers()";
    $message = "SQL ERROR AT /kategorier/ajax/fetch_offers.php";
    $arr     = array();

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0 or !$result)
        return 'Error';

     while($rows = $result->fetch_assoc()){

         $arr[] = $rows;
     }

     return $arr;

    
}

function read_favs($User)
{
    $SQL     = "CALL read_favs('". $_SESSION['id'] ."')";
    $message = "SQL ERROR AT /kategorier/ajax/fetch_offers.php";
    $arr     = array();

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
         return 'NoSubs';
    if(!$result)
        return 'Error';

     while($rows = $result->fetch_assoc()){

      $arr[] = $rows;
    }

     return $arr;
}
?>
