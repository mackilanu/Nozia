<?php

  //require_once 'registerUser.php';  ---> Varför skulle denna behövas?
   require_once("../../MySQL/DBconnect.php");
   $email = $_POST['email'];

    $EmailAvailable;

      $checkEmail = opendb("", "CALL read_email('$email')");
       
      
      if($checkEmail[0] == 1 ){
          $EmailAvailable = true;
      }else{
          $EmailAvailable = false;
      }

      echo $EmailAvailable;
