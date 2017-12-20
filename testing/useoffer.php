<html>
<head>
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	   <script src="../vendor/jquery/jquery.js"></script>

	       <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>

<body bgcolor="green">
<?php
session_start();
require_once("../MySQL/DBconnect.php");
require_once("../includes/navbar.php");

?>
<script type="text/javascript" src="js/erbjudande.js"></script>
<link rel="stylesheet" type="text/css" href="css/timer.css">

<div class="container">

<div class="row">

<div class="col-lg-12" >

<div class="jumbotron">

<h1 style="text-align:center;">Visa denna sida i kassan</h1>

</div>



</div>
</div>

<div class="row">
<div class="col-md-12">
<?php

if($_SESSION['id'] == $_GET['user']){
list($num_rowsUsers, $resultUsers) = opendb("", "CALL read_user('$_GET[user]')");
list($num_rowsOffer, $resultOffer) = opendb("", "CALL read_offer('$_GET[offer]')");

while($rowsUser = $resultUsers->fetch_assoc()){
	while($rowsOffer = $resultOffer->fetch_assoc()){
echo "<h3 style='text-align:center;'><b>Användare:</b> ".$rowsUser['Fname']. ", ".$rowsUser['Username']."</h3>";
echo "<h3 style='text-align:center;'><b>Erbjudande:</b> ".$rowsOffer['Caption']. "</h3><br>";
echo "<div class='col-md-3 col-xs-0'></div>";
echo "<div class='col-md-6 col-xs-12'>";
echo "<input type='hidden' value='". $_GET['offer'] ."' id='offer'>";
echo '<button  class="btn btn-default btn-lg btn-confirm" onclick="UseOffer(offer.value)" id="main-button" style="width: 500px;">Bekräfta</button>';
echo "</div>";
	}
}

}else{
	echo "Du har inte behörighet till detta erbjudande.";
}

?>
 <h3></h3> 
 
</div>

</div>
</div>
</body>

</html>