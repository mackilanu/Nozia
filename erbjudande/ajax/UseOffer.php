<?php

@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");

echo RemoveOffer();

function RemoveOffer(){
	require_once("../../MySQL/DBconnect.php");
	require_once("../../includes/error_log.php");

$offer = $_GET['value'];

	$ID = $_GET['ID'];
	list($num_rows, $result)  = opendb("", "CALL update_MyOffer('$_SESSION[id]', '$offer')");

	if($num_rows == 0 or !$result){
		write_error("Error vid erbjudande/ajax/Useoffer.php. Det gick inte att använda erbjudandet");
		 return '{"status": "Error"}';
		 
	}
	else{
           return '{"status": "OK"}';
       } 
	}