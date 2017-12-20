<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");

fetchcountry();

function fetchcountry(){
    	require_once("../../MySQL/DBconnect.php");

        list($num_rows, $result) = opendb("", "CALL read_Country()");

        if($num_rows == 0 or !$result){
          return '{"status": "Error"}';
        }else{
           return '{"status": "OK"}';
           
        }
}