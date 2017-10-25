<?php
@session_start();

if ($_SESSION['type'] == 0) {
    header("Location: ../kategorier");
}

if (!isset($_SESSION['id'])) {
    
    header("Location: ../foretag");
    
}



require_once("../includes/config.php");
require_once("../MySQL/DBconnect.php");

echo HEAD . "<title>NOZIA - Kontrollpanel</title>" . CLOSE_HEAD;

echo COMPANYNAV;

echo BODY;

require_once("index_con.php");

echo '<link rel="stylesheet" href="../css/foretagindex.css">';
echo '<script type="text/javascript" src="javascript/index.js"></script>';
echo '<script type="text/javascript" src="../includes/common.js"></script>';
echo '<script type="text/javascript">';
echo 'var ID = '. $_SESSION['id'] .';';
echo "var Country  = '';";
echo "Countries = JSON.parse( '" . Countries() . "' );";

echo "var Foretagssida = '';";
echo "Foretagssida = JSON.parse( '" . foretagssida() . "' );";

echo "var Companies = '';";
echo "Companies = JSON.parse( '" . Companies() . "' );";

echo "var kommun  = '';";
echo "kommun = JSON.parse( '" . CityStates() . "' );";


echo "var Offers = '';";
echo "Offers = JSON.parse( '" . Offer() . "' );";

echo "var Post = '';";
echo "Post = JSON.parse('" . CompanyPost() . "');";

echo '</script>';

echo CLOSEBODY;

echo END;


//=================
//DATA SECTION
//=================

//Gets all the citystates and puts it on a JSON object array


//Gets all the countries and puts it on a JSON object array
function Countries()
{
    
    $SQL = "CALL read_Country()";
    
    list($affected_rows, $result) = opendb("", $SQL);
    
    if (!$result or $affected_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    $Country = '{"status": "OK", "Country": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Country .= ',';
        }
        $Country .= json_encode($row);
    }
    $Country .= ']}';
    
    return $Country;   
}

function CityStates()
{
    
    $SQL = "CALL read_CS()";
    
    list($affected_rows, $result) = opendb("", $SQL);
    
    if (!$result or $affected_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    $CS = '{"status": "OK", "CS": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $CS .= ',';
        }
        $CS .= json_encode($row);
    }
    $CS .= ']}';
    $CS = str_replace('\r\n', "<br>", $CS);
    return $CS;  
}

function CompanyPost()
{
    
    $SQL = "CALL read_company_posts('" . $_SESSION['id'] . "')";
    
    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION CompanyPost('" . $_GET['id'] . "')";
    
    list($affected_rows, $result) = opendb($message, $SQL);
    
    if ($affected_rows == 0) {
        return '{"status": "NoOffers"}';
    }
    
    if (!$result) {
        
        return '{"status": "Error"}';
    }
    
    $Company = '{"status": "OK", "post": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Company .= ',';
        }
        $Company .= json_encode($row);
    }
    $Company .= ']}';
    $Company = str_replace('\n\n', "", $Company);
    return $Company;
}
function Offer()
{
    
    $SQL = "CALL read_offers('" . $_SESSION['id'] . "')";
    
    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION Offer('" . $_GET['id'] . "')";
    
    list($affected_rows, $result) = opendb($message, $SQL);
    
    if ($affected_rows == 0) {
        return '{"status": "NoOffers"}';
    }
    
    if (!$result) {
        
        return '{"status": "Error"}';
    }
    
    $Company = '{"status": "OK", "offer": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Company .= ',';
        }
        $Company .= json_encode($row);
    }
    $Company .= ']}';

    $Company = str_replace('\r\n', "", $Company);
    $Company = str_replace('\r\n', "<br>", $Company);
    return $Company; 
}

function foretagssida()
{
    
    $SQL = "CALL read_Foretagssida('" . $_SESSION['id'] . "')";
    
    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION foretagssida('" . $_GET['id'] . "')";
    
    list($affected_rows, $result) = opendb($message, $SQL);
    
    if ($affected_rows == 0) {
        return '{"status": "NoCompany"}';
    }
    
    if (!$result) {
        
        return '{"status": "Error"}';
    }
    
    $Company = '{"status": "OK", "foretag": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Company .= ',';
        }
        $Company .= json_encode($row);
    }
    $Company .= ']}';
    $Company = str_replace('\r\n', "<br>", $Company);
    return $Company; 
}

function Companies()
{
    $SQL = "CALL read_company('" . $_SESSION['id'] . "')";
    
    //$SQL = "CALL read_Companies()";
    $message = "SQL ERROR AT Company/index.php FUNCTION Companies()";
    
    list($affected_rows, $result) = opendb($message, $SQL);
    
    if ($affected_rows == 0) {
        return '{"status": "NoCompany"}';
    }
    
    if (!$result) {
        
        return '{"status": "Error"}';
    }
    
    
    $Company = '{"status": "OK", "Company": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Company .= ',';
        }
        $Company .= json_encode($row);
    }
    $Company .= ']}';
    $Company = str_replace('\r\n', "<br>", $Company);
    return $Company;  
}
?>