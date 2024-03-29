<?php
    require_once("../MySQL/DBconnect.php");

    $verify = $_GET['Vid'];

    $result = opendb("", "CALL read_verify('$verify')");

if($result[0] == 0){
    header("Location: error.php");
}

    $row = $result[1]->fetch_assoc();


   if($row['verify'] == 0){

       $result = opendb("", "CALL update_verifyUser('$verify')");
   }

   if($row['verify'] == 1){

       header("Location: error.php");
   }

  if($_GET['Vid'] == ""){
     header("Location: error.php");
}


?>

<!DOCTYPE html>
<html lang="sv">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NOZIA -Your success is your future</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
           	<div class="container">
               	<div class="row">
                   	<div class="col-md-12">
                       	<img src="img/check_mark.png" width="200" alt="" id="logo">
                       	<h1 id="title" size><font size="20">Du är nu registrerad!</font></h1>
                       	<p>Logga in som privatperson eller som företag här!</p>
              			<div id="btn-contain"></div>
                   			<a href="../registrera" class="btn btn-default btn-lg" id="registration-button">Privatperson</a>
                   			<a href="../registercompany" class="btn btn-default btn-lg" id="registration-button">För Företag</a>
               			</div>
                   	</div>
               	</div>
            </div>
       	</div>
	</header>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>
</body>
</html>


