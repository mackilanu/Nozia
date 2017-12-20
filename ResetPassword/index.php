<?php
@session_start();

if(isset($_SESSION['id'])){
   
   if($_SESSION['type'] == 0){
	header("Location: kategorier/");
}

if($_SESSION['type'] == 1){
	header("Location: Compay/?id="+ $_SESSION['id']);
}
}
 require_once("../includes/config.php");
 require_once("../MySQL/DBconnect.php");

 echo HEAD . "<title>NOZIA - Registrera dig!</title>". CLOSE_HEAD;



 echo BODY;
 require_once("index_con.php");


        echo '<link rel="stylesheet" href="css/index.css">';


 echo CLOSEBODY;

 echo END;

?>

