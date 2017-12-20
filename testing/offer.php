<!DOCTYPE html>
<html lang="en">

<head>
<!--<script type="text/javascript" src="Scripts/toggleoffertype.js">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
       
    <title><?php echo $rows_foretag['Name'];?> -företagssida</title>
</head>
<body>
 <?php require_once("../Scripts/navbar.php");
 require_once("../Scripts/MySQL/DBconnect.php");

   $offers = opendb("", "CALL read_offers");

   while($res = $offers[1]->fetch_assoc()){
       if($_GET['offer'] == $res['ID']){
  ?>

 <div class="container">
   <div class="col-md-2"></div>
      <div class="col-md-8">
      <div class="jumbotron" style="margin-top: 20%;">Bild till erbjudande</div>
      <h2 style="text-align:center;"><?php echo $res['Caption']; ?></h2>

      <p style="text-align:center;"> <?php echo $res['ShortDes'] ?> </p>
      <span class="glyphicon glyphicon-time"></span><p><b>Utgår <?php echo $res['DueDate'] ?></b></p>

      <input type="submit" class="btn btn-success" value="Använd">
      </div>

      

   <div class="col-md-2"></div>
 </div>
 </body>
 <?php
   }
   }
 ?>

 </html>