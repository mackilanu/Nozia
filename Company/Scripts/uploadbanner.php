<?php
//Laddar upp en banner till företaget

if(isset($_POST['newbanner'])){
   require_once("../includes/fileupload.php"); 


	
session_start();
 $result = opendb("", "CALL read_Foretagssida('$_GET[id]')");
 $row = $result[1]->fetch_assoc();
     if (file_exists($row['Banner'])) {
           unlink($row['Banner']);
       } 
$id = $_SESSION['id'];
$file = uploadfile("images/", "bannerfile", "Din banderoll är nu upplagd!");
 $res = opendb("", "CALL update_banner('$file', '$id')");

 header("Location: index.php?id=$_GET[id]");
}                   







	