<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Username = $_GET['Username'];

echo checkCompanyEmail($Username);
//This function checks if the input email is already in use
function checkCompanyEmail($Username){
    
    list($num_rows, $result) = opendb("", "CALL read_companyName('$Username')");

       //If it is, the functions return OK.
    if($num_rows == 0){

        return '{"status": "OK"}';
    }else{

    	if(!$result)
    		return '{"status": "Error"}';

        return '{"status": "Exists"}';
    }
}