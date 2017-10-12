<?php

session_start();
    
if(isset($_POST['NewOffersubmit'])){
   require_once("../includes/fileupload.php");
   require_once("../includes/error_log.php");
 
   $ID          = $_SESSION['id'];
   $caption     = $_POST['Caption'];
   $description = $_POST['Description'];
   $startdate   = $_POST['Startdate'];
   $duedate     = $_POST['Duedate'];
   $fromAge     = $_POST['FromAge'];
   $toAge       = $_POST['ToAge'];
   $file        = uploadfile("images/", "OfferFile", "");
   $CS          = $_POST['CS'];
   $gender      = $_POST['Gender'];


 
   
   list($num_rowsLatest, $resultLatest) = opendb("", "CALL update_latest('$_SESSION[id]')");
   list($num_rows, $result) = opendb("", "CALL insert_Offer('$caption', '$file', '$description', '$startdate' , '$duedate', '$ID', '$fromAge', '$toAge', '1', '$gender')");

   
   if($num_rows == 0 or !$result){
   	     echo "Det gick inte att lägga upp erbjudanet på grund av ett oförutsett fel.";
   	     unlink($file);
           write_error("Error vid Company/Scripts/PostOffer.php. Det gick inte att lägga upp erbjudandet.");
   }else{

   list($num_rowsUsers, $resultUsers) = opendb("", "CALL read_Users()");
   list($num_rowsOffer, $resultOffer) = opendb("", "CALL read_InsertToMyOffers('$caption', '$_SESSION[id]')");
   $rowOffer                          = $resultOffer->fetch_assoc();

   while($rowsUsers = $resultUsers->fetch_assoc()){
     
       list($num_rowsMyoffer, $resultMyoffer) = opendb("", "CALL insert_MyOffer('$rowsUsers[ID]', '$rowOffer[ID]')");
   }
   
    list($numrowsOffer, $resultOffer) = opendb("", "CALL read_offerWithParams('". $_SESSION['id'] ."', '". $caption ."')");

    $rowsoffer = $resultOffer->fetch_assoc();

   for($i = 0; $i <= count($CS); $i++ ){
   list($numrowsCS, $resultCS) = opendb("", "CALL insertOfferCS('".  $CS[$i] ."', '". $rowOffer['ID'] ."')");

}

   header("Location: index.php?id=$_SESSION[id]");
   write_error("Lyckad tilläggning av erbjudande från företaget: ". $_SESSION['id']);
   	echo "Ditt erbjudande är nu upplagt!";

   }

   }
