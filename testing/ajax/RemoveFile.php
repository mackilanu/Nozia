<?php

@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");

echo RemoveFile();

function RemoveFile(){
	require_once("../../MySQL/DBconnect.php");

	$ID   = $_SESSION['id'];
	$file = $_GET['file'];

	list($num_rows, $result)  = opendb("", "CALL update_company_files('$ID', '$file')");

	if($num_rows == 0 or !$result){
		 return '{"status": "Error"}';
	}
	else{
		  if(file_exists("../".$file)) {
           unlink("../".$file);
           return '{"status": "OK", "value": "$ID"}';
        
       } else { 
           return '{"status": "NotDeleted"}';
       }
	}


}