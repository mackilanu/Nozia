<?php
	//require_once 'registerUser.php';  ---> Varför skulle denna behövas?
   require_once("../../MySQL/DBconnect.php");
   $username = $_POST['username'];

	  $usernameAvailable;
	  $userlenght;
      $checkUsername = opendb("", "CALL read_usernames('$username')");
       
       // if(strlen($username) < 6){
       // 	$userlenght = false;
       // }else{
       // 	$userlenght = true;
       // }
        

      if($checkUsername[0] == 1 ){
          $usernameAvailable = true;
      }else{
          $usernameAvailable = false;
      }

      echo $usernameAvailable;

