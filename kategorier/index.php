<?php

@session_start();


if(!isset($_SESSION['id'])){

    header("Location: ../");
}
require_once("../includes/config.php");
require_once("../MySQL/DBconnect.php");

echo HEAD . "<title>NOZIA - Kategorier</title>". CLOSE_HEAD;

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
echo "var likes='';";
echo "likes = JSON.parse( '" . test() . "' );";
echo "var CS = ".$_SESSION['citystate'].";";
echo "var kommun  = '';";
echo "kommun = JSON.parse( '" . CityStates() . "' );";

echo "user_id =". $_SESSION['id']. ";";
echo "var Categories  = '';";
echo "Categories = JSON.parse( '" . Categories() . "' );";

echo "var Companies = '';";
echo "Companies = JSON.parse('". Companies() ."')";

echo '</script>';

echo CLOSEBODY;

echo END;

function test(){

    $SQL     = "CALL read_checkIfLiked('". $_SESSION['id'] ."')";

    list($affected_rows, $result) = opendb("", $SQL);

    if(!$result or $affected_rows == 0){

        return '{"status": "Error"}';
    }

    $CS = '{"status": "OK", "like": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $CS .=  ',';
        }
        $CS     .=  json_encode($row);
    }
    $CS         .= ']}';
    
    return $CS;


}


function CityStates(){
      
    $SQL = "CALL read_CS()";

    list($affected_rows, $result) = opendb("", $SQL);

    if(!$result or $affected_rows == 0){

    	return '{"status": "Error"}';
    }

    $CS = '{"status": "OK", "CS": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $CS .=  ',';
        }
        $CS     .=  json_encode($row);
    }
    $CS         .= ']}';

    return $CS;

}

function Companies(){

    $SQL     = "CALL read_CompanyUsernames()";
    list($affected_rows, $result) = opendb("", $SQL);

    if(!$result or $affected_rows == 0){

        return '{"status": "Error"}';
    }

    $company = '{"status": "OK", "company": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $company .=  ',';
        }
        $company     .=  json_encode($row);
    }
    $company         .= ']}';

    return $company;

}

//Gets all the categories and puts it on a JSON object array
function Categories(){
    
    $SQL = "CALL read_categories()";

    list($affected_rows, $result) = opendb("", $SQL);

    if(!$result or $affected_rows == 0){

    	return '{"status": "Error"}';
    }

    $Category = '{"status": "OK", "Category": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Category .=  ',';
        }
        $Category     .=  json_encode($row);
    }
    $Category         .= ']}';

    return $Category;
}

?>

