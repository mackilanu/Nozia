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

require_once("index_con.html");

echo '<link rel="stylesheet" href="../css/lab.css">';
echo '<script type="text/javascript" src="../includes/common.js"></script>';
echo '<script type="text/javascript" src="javascript/index.js"></script>';
echo '<script type="text/javascript">';
echo 'var Email = "'. $_SESSION['email'] .'";';
echo 'var Name = "'. $_SESSION['firstname'] .'";';
echo '</script>';


echo CLOSEBODY;

echo END;





  
?>

  