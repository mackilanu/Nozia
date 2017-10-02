<?php
@session_start();


 require_once("../includes/config.php");
 require_once("../MySQL/DBconnect.php");

 echo HEAD . "<title>NOZIA - Registrera ditt företag!</title>". CLOSE_HEAD;

 echo STARTNAV;

 echo BODY;

 require_once("index_con.php");

 echo '<link rel="stylesheet" href="../css/foretagindex.css">';
 echo '<script type="text/javascript" src="javascript/index.js"></script>';

 echo '<script type="text/javascript">';
 echo "var kommun  = '';";
 echo "kommun = JSON.parse( '" . CityStates() . "' );";

 echo "var Country  = '';";
 echo "Countries = JSON.parse( '" . Countries() . "' );";

 echo "var Categories  = '';";
 echo "Categories = JSON.parse( '" . Categories() . "' );";

 echo '</script>';

 echo CLOSEBODY;

 echo END;


//=================
//DATA SECTION
//=================

   //Gets all the citystates and puts it on a JSON object array
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

 //Gets all the countries and puts it on a JSON object array
 function Countries(){

 	$SQL = "CALL read_Country()";

    list($affected_rows, $result) = opendb("", $SQL);

    if(!$result or $affected_rows == 0){

    	return '{"status": "Error"}';
    }

      $Country = '{"status": "OK", "Country": [';
    for ($i = 0; $i < $affected_rows; ++$i){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0){
            $Country .=  ',';
        }
        $Country     .=  json_encode($row);
    }
    $Country         .= ']}';

  return $Country;

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
