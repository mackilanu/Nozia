<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Username = $_GET['Username'];
$Password = hash('sha256', $_GET['Password']);

echo login($Username, $Password);
//This function checks if the input Username and Password is correct
function login($Username, $Password){
    $SQL = "CALL read_companylogin('". $Username ."', '". $Password ."')";
    list($num_rows, $result) = opendb("", $SQL);
     
    //If the login is valid $num_rows will return 1
    if($num_rows == 0)  return '{"status": "NoAuth"}';
 

    if(!$result) return '{"status": "Error"}'; 


    $row = $result->fetch_assoc();


    //if($row['Verify'] == 0) return '{"status": "NotVerified"}';
    
    $ID       = $row['ID'];
    $Username = $row['Username'];
    $Password = $row['Password'];
    $CS       = $row['CS'];
    $Name     = $row['Name'];
    $orgnr    = $row['Orgnr'];
    $Email    = $row['Email'];
    $verify   = $row['Verify'];
    $Category = $row['Category'];

    if(isset($_SESSION['id'])){
        session_destroy();
    }

    $_SESSION['id']       = $ID;
    $_SESSION['Username'] = $Username;
    $_SESSION['Password'] = $Password;
    $_SESSION['CS']       = $CS;
    $_SESSION['Name']     = $Name;
    $_SESSION['orgnr']    = $orgnr;
    $_SESSION['Email']    = $Email;
    $_SESSION['verify']   = $verify;
    $_SESSION['type']     = 1;
    $_SESSION['Category'] = $Category;
    return '{"status": "Auth", "ID": "'. $ID .'"}'; 
}