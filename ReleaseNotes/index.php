<?php

@session_start();


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
 echo "Note = JSON.parse('". Notes() ."');";


 echo '</script>';

 echo CLOSEBODY;

 echo END;


//Reads all the necessary information about the user.

 function Notes(){
    $SQL     = "CALL read_Notes()";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT ReleaseNotes/index.php FUNCTION Notes()";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "Error"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

    
    

       $Company = '{"status": "OK", "note": [';
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

