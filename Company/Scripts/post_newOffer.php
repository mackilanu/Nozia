<?php
	function msg($message, $type){

    if($type == "danger"){
     echo "<div  class='alert alert-danger ' style='text-align: left' id='success_alert'>$message</div>";
    }

    if($type == "success"){
    	echo "<div  class='alert alert-success' style='text-align: left' id='success_alert'>$message</div>";
    }
}

if(isset($_POST['submit_newOffer'])){

    require_once("../includes/fileupload.php");
   $name        = $_POST['name'];
   $description = $_POST['description'];
   $startdate   = $_POST['date1'];
   $duedate     = $_POST['date2'];
   $image       =  uploadfile("images/", "offerimage", "hej");
   $id          = $_SESSION['id'];

   $result = opendb("", "CALL insert_Offer('$name', '$image', '$description' , '$startdate', '$duedate', '$id')");

   if($result[0] == 1){

$result_users = opendb("", "CALL read_Users()");
$result_offers = opendb("", "CALL read_InsertToMyOffers('$name')");
$result_offers1 = $result_offers[1]->fetch_assoc(); //Hämtar id:t på erbjudandet som ska läggas till i MyOffers

//Lägger till en rad i MyOffers för varje User
       while($rows = $result_users[1]->fetch_assoc()){
          
          opendb("", "CALL insert_MyOffer('$rows[ID]', $result_offers1[ID])");
       
     }


    msg("Erbjudandet är nu upplagt!" . print_r($_POST), "success");
   }else{
       msg("Det gick inte att lägga upp erbjudandet, vänligen kontakta administratör för assistans.", "danger");
   }
}