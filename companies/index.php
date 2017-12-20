<?php

@session_start();

if(!isset($_SESSION['id'])){

    header("Location: ../");
}
 require_once("../includes/config.php");
 require_once("../MySQL/DBconnect.php");

 echo HEAD . "<title>NOZIA - Välj företag</title>". CLOSE_HEAD;

 echo NAV;

 echo BODY;
 require_once("index_con.php");


        echo '<link rel="stylesheet" href="../css/lab.css">';
        echo '<script type="text/javascript" src="javascript/index.js"></script>';

 echo '<script type="text/javascript">';
 echo "var CS = ". $_SESSION['citystate'].";";

 echo "var CityState = ". $_GET['id']. ";";
 echo "var category = ". $_GET['category'].";";

 echo "var Companies = '';";
 echo "Companies = JSON.parse('". Companies() ."');";

 echo "var Icons = '';";
 echo "Icons = JSON.parse('". CompanyIcons() ."');"; 
echo "var CS = '". $_GET['id'] ."';";
 echo '</script>';

 echo CLOSEBODY;

 echo END;


//================
//KANKE SKA RADERAS
 //================

 function Companies(){
    $SQL     = "CALL read_companyParams('". $_GET['id'] ."', '". $_GET['category'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Companies/index.php FUNCTION Companies()";

     list($affected_rows, $result) = opendb($message, $SQL);

     if($affected_rows == 0){
         return '{"status": "NoCompanies"}';
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

/* function Cross_Offers(){ */

/*     $Companies = array(); */
/*     $SQL = "CALL read_Offer_CS('". $_GET['id'] ."')"; */
/*     $message_data = "SQL-ERROR at companies/index.php function Cross_offers(". $_GET['id']  . ""; */

/*     list($num_rows, $result) = opendb($message_data, $SQL); */

/*     if($num_rows == 0) return "NoMatch"; */
/*     if(!$result) return "Error"; */

/*     while($row_OfferID = $result->fetch_assoc()){ */

/*         $SQL = "CALL read_offer('".$row_OfferID['Offer']."') "; */

/*         list($num_rows, $resultOffer) = opendb($message_data, $SQL); */

/*         if(!$resultOffer) return "Error"; */

/*         $row_CompanyID =  $resultOffer_fetch_assoc(); */

/*         $Companies[] = $row_CompanyID['CompanyID']; */

/*     } */

/*     $num_companies = count($Companies); */

/*     for($i = 0; $i < $num_companies; $i++){ */

/*         $SQL = "CALL read_company('". $Companies[$i] ."')"; */

/*         list($num_rows, $result_company) = opendb($message_data, $SQL); */

/*         $row_Company = $result_company->fetch_assoc(); */

/*         if($_GET['company'] == $row_Company['Category']){ */

/*             return "OK"; */

/*         } */

/*     } */


/* } */



 function CompanyIcons(){

    $SQL     = "CALL read_CompanyIcon()";
    $message = "SQL ERROR AT companies/index.php FUNCTION CompanyIcons()";

     list($affected_rows, $result) = opendb($message, $SQL);

      if(!$result or $affected_rows == 0){

        return '{"status": "Error"}';
    }
    

       $Icon = '{"status": "OK", "Icon": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Icon .=  ',';
        }
        $Icon     .=  json_encode($row);
    }
    $Icon         .= ']}';

  return $Icon;

 }


  
?>

