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

if(CompanyCategory() == 25){
    require_once("index_con_forening.php");
}else{
    require_once("index_con.php");
}

echo '<link rel="stylesheet" href="../css/lab.css">';
echo '<script type="text/javascript" src="javascript/index.js"></script>';
echo '<script type="text/javascript" src="../includes/common.js"></script>';

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
echo "var fav = '';";
echo "fav = JSON.parse('". read_fav() ."');";
echo "var files = '';";
echo "files = JSON.parse('". read_files() ."');";
echo "var Category = '';";
echo "Category = ".  CompanyCategory() .";";
echo "var Sponsors = '';";
echo "Sponsors=JSON.parse('". read_Sponsors() ."');";
echo '</script>';


echo CLOSEBODY;

echo END;

function CompanyCategory(){

    $SQL     = "CALL read_companyCategory('". $_GET['id'] ."')";

    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION CompanyCategory($_GET[id])";

    list($affected_rows, $result) = opendb($message, $SQL);

    if($affected_rows == 0){
        return '{"status": "NoCompany"}';
    }

    if(!$result){

        return '{"status": "Error"}';
    }

    $row = $result->fetch_row();

    return $row[0];


} 


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

    
    $likes = array();

    $Company = '{"status": "OK", "Company": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Company .=  ',';
        }
        $Company     .=  json_encode($row);
    }
    $Company         .= ']}';
    
    $Company = str_replace('\r\n', "<br>", $Company);
    return $Company;


}

function read_likes($Offer){
    
    $SQL     = "CALL read_likes_length('". $Offer ."')";
     
    $message = "SQL ERROR AT Company/index.php FUNCTION read_fav('". $_SESSION['id'] ."','". $_GET['id'] ."')";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result)
        return 'Error';

    return $num_rows;
    
    
}

function read_files(){
    $SQL     = "CALL read_company_files('". $_GET['id'] ."')";
    $message = "SQL-ERROR AT controlpanel/ajax/get_files.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result)
        return '{"status": "Error"}';

    if($num_rows == 0)
        return '{"status": "NoFiles"}';

    $Files = '{"status": "OK", "file": [';
    for ($i = 0; $i < $num_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Files .= ',';
        }
        $Files .= json_encode($row);
    }
    $Files .= ']}';
    
    return $Files;   

}

function read_Sponsors(){
    
    $SQL     = "CALL read_sponsors('". $_GET['id'] ."')";
    $message = "SQL-ERROR AT controlpanel/ajax/get_files.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result)
        return '{"status": "Error"}';

    if($num_rows == 0)
        return '{"status": "NoFiles"}';

    $Files = '{"status": "OK", "sponsor": [';
    for ($i = 0; $i < $num_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Files .= ',';
        }
        $Files .= json_encode($row);
    }
    $Files .= ']}';
    
    return $Files;   

    
}

function read_fav(){

    $SQL     = "CALL read_fav('". $_SESSION['id'] ."','". $_GET['id'] ."')";
     
    $message = "SQL ERROR AT Company/index.php FUNCTION read_fav('". $_SESSION['id'] ."','". $_GET['id'] ."')";

    list($affected_rows, $result) = opendb($message, $SQL);

    if($affected_rows == 0){
        return '{"status": "not_fav"}';
    }

    if(!$result){

        return '{"status": "Error"}';
    }

    $fav = '{"status": "OK", "fav": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $fav = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $fav .=  ',';
        }
        $fav     .=  json_encode($row);
    }
    $fav         .= ']}';

    return $fav;

    
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

    $likes = array();

    $Company = '{"status": "OK", "offer": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $likes[] = read_likes($row['ID']);

        if ($i > 0){
            $Company .=  ',';
        }
        $Company     .=  json_encode($row);
    }
    $Company         .= '],';
    $Company .= '"likes": [';
    for($i = 0; $i < count($likes); $i++){
        
        if($i > 0)
            $Company .= ",";
        
        $Company .= $likes[$i];
        
    }

    $Company .= "]}";

    $Company = str_replace('\r\n', "<br>", $Company);
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
    $Company = str_replace('\n\n', "<br>", $Company);
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
    $Company = str_replace('\r\n', "<br>", $Company);
    return $Company;



}


  
?>

  