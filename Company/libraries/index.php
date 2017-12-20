<?php

@session_start();

if(!isset($_SESSION['id'])){

    header("Location: ../");
}
 require_once("../includes/config.php");
 require_once("../MySQL/DBconnect.php");

 echo HEAD . "<title>NOZIA - Registrera dig!</title>". CLOSE_HEAD;

if($_SESSION['type'] == 0){
 echo NAV;

}

if($_SESSION['type'] == 1){

    echo COMPANYNAV;
}

 echo BODY;
 require_once("index_con.php");


        echo '<link rel="stylesheet" href="../css/lab.css">';
        echo '<script type="text/javascript" src="javascript/index.js"></script>';

 echo '<script type="text/javascript">';
 echo "var CS = '". $_SESSION['citystate']."';";

 echo "var Company = ". $_GET['id'] .";";
 echo "var Companies = '';";
 echo "Companies = JSON.parse('". Companies() ."');";

 echo "var Foretagssida = '';";
 echo "Foretagssida = JSON.parse('". foretagssida() ."');";

 echo "var Offers = '';";
 echo "Offers = JSON.parse('". Offer() ."');";

  echo "var Post = '';";
 echo "Post = JSON.parse('". CompanyPost() ."');";

 echo '</script>';


 echo CLOSEBODY;

 echo END;


 function Companies(){
    $SQL     = "CALL read_company('". $_GET['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION Companies()";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "NoCompany"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

    
    

       $Company = '{"status": "OK", "Company": [';
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

 function Offer(){

  $SQL     = "CALL read_offers('". $_GET['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION Offer('". $_GET['id'] ."')";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "NoOffers"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

       $Company = '{"status": "OK", "offer": [';
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

 function CompanyPost(){
     
       $SQL     = "CALL read_company_posts('". $_GET['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION CompanyPost('". $_GET['id'] ."')";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "NoOffers"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

       $Company = '{"status": "OK", "post": [';
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

 function foretagssida(){

      $SQL     = "CALL read_Foretagssida('". $_GET['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION foretagssida('". $_GET['id'] ."')";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "NoCompany"}';
    }

      if(!$result){

        return '{"status": "Error"}';
    }

       $Company = '{"status": "OK", "foretag": [';
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

  