<?php

@session_start();

if(!isset($_SESSION['id'])){

    header("Location: ../");
}
 require_once("../includes/config.php");
 require_once("../MySQL/DBconnect.php");

 echo HEAD . "<title>NOZIA - Mitt konto</title>". CLOSE_HEAD;

 echo NAV;

 echo BODY;
 require_once("index_con.php");


        echo '<link rel="stylesheet" href="../css/lab.css">';
      
        echo '<script type="text/javascript" src="javascript/index.js"></script>';

 echo '<script type="text/javascript">';
 echo "var User = '';";
 echo "User = JSON.parse('". User() ."');";


 echo '</script>';

 echo CLOSEBODY;

 echo END;


//Reads all the necessary information about the user.

 function User(){
    $SQL     = "CALL read_user('". $_SESSION['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT mittkonto/index.php FUNCTION User()";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "Error"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

    
    

       $Company = '{"status": "OK", "info": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Company .=  ',';
        }
        $Company     .=  json_encode($row);
    }
    $Company         .= ']}';

  return $Company;


 }  
?>

