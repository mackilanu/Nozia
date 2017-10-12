<!DOCTYPE html>
<html lang="sv">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NOZIA -Your success is your future</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/format.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="padding-top: 0px;">

<?php
require_once("../MySQL/DBconnect.php");
require_once("../includes/navbar.php");
date_default_timezone_set("Europe/Stockholm");
   session_start();

  

   $offer = $_GET['offer'];
   $date = getdate();

   $day   = $date['mday'];
   $month = $date['mon'];
   $year  = $date['year'];

   

   if($month < 10){
     $month = "0". $month;
   }   

    list($yearUser,$monthUser,$dayUser)=explode("-", $_SESSION['birthday']);

  

   $DagensDatum = $year ."-". $month ."-". $day;

   list($num_rows, $result)  = opendb("", "CALL read_offer('$offer')");
   list($num_rowsMyOffer, $resultMyOffer)  = opendb("", "CALL read_MyOffer('$_SESSION[id]', '$offer')");
   $rowsMyOffer = $resultMyOffer->fetch_assoc();

   if($rowsMyOffer != 0 || $_SESSION['type'] == 1 && $_SESSION['id'] == $_GET['id'] ){

   while($rows = $result->fetch_assoc()){ 
?>



    <div class="container" id="outerContainer">
        <div class="container" id="innerContainer">
            <img src="../Company/<?php echo $rows[Image]?>" id="offerIcon">
            <div class="row">
                <div class="col-md-4">
                   <img src="img/location.png" class="infoLabel">
                    <p class="info">Södra Klaragatan 28b, Karlstad, Värmland</p>
                </div>
                <div class="col-md-4">
                    <h1 style="margin: 0;"><?php echo $rows['Caption'];  ?></h1>
                </div>
                <div class="col-md-4">
                    <img src="img/clock.png" class="infoLabel">
                    <p class="info"><?php echo $rows['StartDate'] . " - ". $rows['DueDate']; ?> </p>
                </div>
            </div>
            <hr>
            <div class="row" style="width: 80%; margin: auto;">
                <div>
                     <p id="description" style="text-align:center;">
                     <?php
                      echo $rows['ShortDes'];
                   

                     ?>
                    </p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 48px;">
             
             <div id="btn-contain">
           <?php
              if($rowsMyOffer['Used'] == 1){

              	echo '  <a href="#" class="btn btn-default btn-lg btn-redeemed" id="main-button" style="width: 300px;">Redan använd</a>';
              }

              elseif($DagensDatum > $rows['DueDate']){
              	echo ' <a href="#" class="btn btn-default btn-lg btn-expired" id="main-button" style="width: 300px;">Utgått</a>';
              }
              elseif($DagensDatum < $rows['StartDate']){
              	echo '  <a href="#" class="btn btn-default btn-lg btn-expired" id="main-button" style="width: 300px;">Startar '. $rows['StartDate'].'</a>';
              }

              else{
              	echo '  <a href="useoffer.php?offer='.$_GET['offer'].'&user='.$_SESSION['id'].'&myofferid='.$rowsMyOffer['ID'].'" class="btn btn-default btn-lg btn-confirm" id="main-button" style="width: 300px;">Använd</a>';
              }

             
             ?>
                 </div>
                  
               


            </div>
        </div>
    </div>
	</header>
    <!-- Footer -->
  

    <!-- jQuery -->

    <!-- Theme JavaScript -->

<?php

}


   }else{
	echo "Du har inte behöriget till detta erbjudande.";
}
?>
  <div class="container" id="footer">
        <h5 id="copyright-text">Copyright &copy; Nozia advertising Ltd Uk filial 2017 
        <p style="font-size: 10pt; margin-bottom: 0;">Org-nr: 516410-8242 </p></h5>
    </div>

        <script src="../vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <script src="js/grayscale.min.js"></script>
    <script src="js/grayscale.js"></script>

</body>
</html>