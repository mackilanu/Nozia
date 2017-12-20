<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$email = $_GET['CompanyEmail'];

echo checkCompanyEmail($email);
//This function checks if the input email is already in use
function checkCompanyEmail($email){
    
    list($num_rows, $result) = opendb("", "CALL read_CompanyEmail('$email')");

       //If it is, the functions return OK.
    if($num_rows == 0){

        return '{"status": "OK"}';
    }else{

    	if(!$result)
    		return '{"status": "Error"}';

        return '{"status": "Exists"}';
    }
}