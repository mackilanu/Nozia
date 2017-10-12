<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Category = $_GET['Category'];

if($Category == "-1"){
    echo '{"status": "DisplayAll"}';
    return;
}

echo display_offers($Category);

function display_offers($Category)
{
    $companies = get_companies($Category);

    if($companies == 'NoCompanies')
        return '{"status": "NoCompanies"}';
    if($companies == "Error")
        return '{"status": "Error"}';

    $offers = get_offers($companies);

    if($offers == "NoOffers")
        return '{"status": "NoOffers"}';
    if($offers == "Error")
         return '{"status": "Error"}';

      $s = '{"status": "OK", "offers": [';
    for($i = 0; $i < count($offers); $i++){
        if($i > 0)
            $s .= ",";
        $s .= json_encode($offers[$i]);
    }

   $s .= ']}';
    
    return $s;
}

function get_companies($Category)
{
    $SQL = "CALL read_CompanyCategory('". $Category ."')";
    $message = "SQL-ERROR AT kategorier/ajax/get_offers.php";
    $arr = array();

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return 'NoCompanies';

    if(!$result)
        return  'Error';

    while($row = $result->fetch_assoc()){
        $arr[] = $row;
    }

    return $arr;    



}

function get_offers($Companies)
{
    $SQL = "CALL read_AllOffers()";
    $message = "SQL-ERROR AT kategorier/ajax/get_offers.php";
    $arr = array();

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return 'NoOffers';

    if(!$result)
        return  'Error';

    while($row = $result->fetch_assoc()){
        
        for($i = 0; $i < count($Companies); $i++){

            if($Companies[$i]['ID'] == $row['CompanyID']){

                $arr[] = $row;
            }
        }
    }

    if(count($arr) == 0){
        return 'NoOffers';
    }

    return $arr;    

}


?>
