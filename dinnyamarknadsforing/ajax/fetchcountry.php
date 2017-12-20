<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");

echo fetchcountry();

function fetchcountry(){
    	require_once("../../MySQL/DBconnect.php");

        list($num_rows, $result) = opendb("", "CALL read_Country()");

        if($num_rows == 0 or !$result){
          return '{"status": "Error"}';
        }else{
          

               $Ledighet = '{"status": "OK", "country": [';
    for ($i = 0; $i < $num_rows; ++$i){

        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Ledighet .=  ',';
        }
        $Ledighet     .=  json_encode($row);
    }
    $Ledighet       .= ']}';
    return $Ledighet;
           
        }
}