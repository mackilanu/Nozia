<?php
@session_start();

if (isset($_SESSION['id'])) {
	if ($_SESSION['type'] == 0) {
		header("Location: kategorier/");
	}

	if ($_SESSION['type'] == 1) {
		header("Location: Compay/?id=" + $_SESSION['id']);
	}
}

require_once ("includes/config.php");

require_once ("MySQL/DBconnect.php");

echo HEAD . "<title>NOZIA - Registrera dig!</title>" . CLOSE_HEAD;
echo STARTNAV;
echo BODY;
require_once ("index_contest.php");

echo '<link rel="stylesheet" href="css/lab.css">';
echo '<script type="text/javascript" src="register/javascript/login.js"></script>';
echo '<script type="text/javascript" src="register/javascript/register.js"></script>';
echo CLOSEBODY;
echo END;
?>
