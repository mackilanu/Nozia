<?php

@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");

echo RemoveOffer();

function RemoveOffer(){
	require_once("../../MySQL/DBconnect.php");
	require_once("../../includes/error_log.php");





	$ID = $_GET['ID'];
	list($num_rowsFile, $resultFile)  = opendb("", "CALL read_offerImage('$ID')");
	$file = $resultFile->fetch_assoc();
    

	list($num_rows, $result)  = opendb("", "CALL update_Offer('$ID')");

	if($num_rows == 0 or !$result){
		 return '{"status": "Error"}';
		 write_error("Errror vid Company/ajax/RemoveOffer.php. Det gick inte att ta bort erbjudandet. ");
	}
	else{
		  if(file_exists("../".$file['Image'])) {
           unlink("../".$file['Image']);
       }
           return '{"status": "OK"}';

           write_error("Lyckad borttagning av erbjudande från företaget: " .$_SESSION['id']);
        
       } 
	}

