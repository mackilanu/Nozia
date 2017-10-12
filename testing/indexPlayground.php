<!DOCTYPE html>
<html lang="en" >

<head>
<!--<script type="text/javascript" src="Scripts/toggleoffertype.js">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/format.css">
    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="ajax/company.js"></script>



<?php
require_once("../MySQL/DBconnect.php");
session_start();


 $result = opendb("", "CALL read_Companies()");

//Hämtar datan från tabellen Companies
while($rows = $result[1]->fetch_assoc())
{

    

//Om URL-parametern stämmer överenns med företagets id så körs detta
if($_GET['id'] == $rows['ID'])
{

    
 $res_foretag = opendb("", "CALL read_Foretagssida('$_GET[id]')");


    while($rows_foretag = $res_foretag[1]->fetch_assoc()){

        $hej = true;

     
        
        //Och om  URL-parametern stämer överenns med företagets ID, så köra sidan.
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
       
    <title><?php echo $rows['Name'];?> -företagssida</title>

    <style type="text/css">
     

      body{

      	background-image: url("<?php echo $rows_foretag[Background]?>");
        background-repeat: no-repeat;
        background-size: cover;

      }	 


    </style>
</head>

<body>
<?php
 // require_once("../Scripts/navbar.php"); 
  require_once("Scripts/newOfferModal.php");
  require_once("Scripts/newoffer.php");
  require_once("Scripts/changePostModal.php");
  require_once("Scripts/changeInfoModal.php");
  require_once("Scripts/UpdateLogo.php");
  require_once("Scripts/AddFile.php");
  require_once("Scripts/ChangeBackground.php");



?>
  
<!-- Ska bara finnas om sessionsvariabel för CompanyUser finns, och som stämmer överenns med företagets ID. -->
    <!-- Page Content


<div class="container" style="margin-top: 50px; background-color: #EEE; height: 100%; padding-left: 15px; padding-right: 15px; padding-top: 15px;">
	<div class="container" style="background-color: #FFF; height: 100%; width: 100%; margin-top: 0; border: 1px solid;
	border-color: #BBB;">
		  <div style="border-radius: 0;" class="jumbotron">
<div class="jumbotron jumbotron-style center img-responsive" style="background: url(<?php echo $rows_foretag['Banner']; ?>); background-repeat: no-repeat; overflow: hidden;
   
    background-position: center;  width: auto; height: 200px; border-radius: 0;"></div>


<div class="col-md-4">

               <h4 style=""><span class="glyphicon glyphicon-earphone" style="margin-right: 5px;"></span><?php echo $rows_foretag['Telefon']; ?></h4>

            </div>

            <div class="col-md-4">
               <h4><span class="glyphicon glyphicon-home" style="margin-right: 5px;"></span><?php echo $rows_foretag['Adress']; ?> </h4>
              
            </div>

            <div class="col-md-4">
             <h4><span class="glyphicon glyphicon-pencil"></span> <?php echo $rows_foretag['Postnr']; ?></h4>
        
            </div>
            <?php if($_SESSION['id'] == $_GET['id']){ ?>
          <input type="submit" class="btn btn-success" value="Ändra uppgifter" data-toggle="modal" data-target="#changeInfo">

         <?php } ?>
        Portfolio Item Heading
        <div class="row">
            <div class="col-lg-12">
                <h1 style="text-align: center;" class="page-header"><?php echo $rows['Name']; ?>
                                 <?php

                                 echo <<<ICON
                <div class="col-lg-4 col-sm-12 col-xs-12 text-center" style="">
                	<div class="square circle-format">
                		<a href="#">
                   			<img src="$rows[Icon]" class="img-responsive circle-format" style="margin-bottom: 5px;" alt="Company Profile Picture">
                		</a>
ICON;
                   if($_SESSION['id'] == $_GET['id']){
                    $hej = true;
                   echo '<br><button type="button" class="btn btn-info" data-toggle="modal" data-target="#changeLogo">Byt logo</button>';
                 }

                echo "<br></h1>
                <div class='col-lg-4'></div>";


                   list($num_rows , $result)  = opendb("","CALL read_Foretagssida('$_GET[id]')");

                   	if($num_rows != 0){

                   		while($rows = $result->fetch_assoc()){
                         

            
         			}
    			}?>
                    
              	</div>
              	<br>
            	</div>
            <small><?php echo $rows_foretag['Slogan']; ?></small>
            </div>
        </div>
	</div>
</div>-->




    <div class="container" style="margin-top: 50px; margin-bottom: 0; border-radius: 0;">
    <?php
        require_once("Scripts/uploadbanner.php");
          function message($message, $type){

    if($type == "danger"){
     echo "<div  class='alert alert-danger ' style='text-align: left' id='success_alert'>$message</div>";
    }

    if($type == "success"){
    	echo "<div  class='alert alert-success' style='text-align: left' id='success_alert'>$message</div>";
    }
}

    ?>
    
    <?php  
    
    
if($_SESSION['id'] == $_GET['id']){

      require_once("Scripts/post_newOffer.php");
     echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#changebanner">Byt banner</button>';
     echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Changebackground">Byt Bakgrund</button>';
   
 }


         
?>

<div class="container" style="; margin: 0;">
	<div class="container" style="background-color: #FFF">
		
  <div style="border-radius: 0;" class="jumbotron">
<div class="jumbotron jumbotron-style center img-responsive" style="background: url(<?php echo $rows_foretag['Banner']; ?>); background-repeat: no-repeat; overflow: hidden;
   
    background-position: center;  width: auto; height: 200px; border-radius: 0;"></div>


<div class="col-md-4">

               <h4 style=""><span class="glyphicon glyphicon-earphone" style="margin-right: 5px;"></span><?php echo $rows_foretag['Telefon']; ?></h4>

            </div>

            <div class="col-md-4">
               <h4><span class="glyphicon glyphicon-home" style="margin-right: 5px;"></span><?php echo $rows_foretag['Adress']; ?> </h4>
              
            </div>

            <div class="col-md-4">
             <h4><span class="glyphicon glyphicon-pencil"></span> <?php echo $rows_foretag['Postnr']; ?></h4>
        
            </div>
            <?php if($_SESSION['id'] == $_GET['id']){ ?>
          <input type="submit" class="btn btn-success" value="Ändra uppgifter" data-toggle="modal" data-target="#changeInfo">

         <?php } ?>
        <!-- Portfolio Item Heading -->
        <div class="row">

            <div class="col-lg-12">
                <h1 style="text-align: center;" class="page-header"><?php echo $rows['Name']; ?>

                                 <?php
                   if($_SESSION['id'] == $_GET['id']){
                    $hej = true;
                   echo '<br><button type="button" class="btn btn-info" data-toggle="modal" data-target="#changeLogo">Byt logo</button>';
                 }

                echo "<br></h1>
                <div class='col-lg-4'></div>";


                   list($num_rows , $result)  = opendb("","CALL read_Foretagssida('$_GET[id]')");

                   	if($num_rows != 0){

                   		while($rows = $result->fetch_assoc()){
                         

            echo <<<ICON
                 <div class="col-lg-4 col-sm-12 col-xs-12 text-center" style="">
                <div class="square circle-format">
                <a href="#">
              
                   <img src="$rows[Icon]" class="img-responsive circle-format" style="margin-bottom: 5px;" alt="Company Profile Picture"></a>

ICON;

         }
         }
                ?>
                    
              </div>
              <br>
              
              
            </div>
      
            
                    <small><?php echo $rows_foretag['Slogan']; ?></small>
                
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="jumbotron">
            <?php  
            if($_SESSION['id'] == $_GET['id']){

            	 echo '<br><button type="button" class="btn btn-info" data-toggle="modal" data-target="#AddFile">Hantera filer</button>';
            }

            ?>
            <p><b>Filer</b></p>

     <?php
        list($num_rows, $result) = opendb("", "CALL read_Company_files('$_GET[id]')");

        if($num_rows != 0){

          echo "<ul style='list-style-type: none;'>";

        	while ($rows = $result->fetch_assoc()) {
        	echo "<li> <a href='$rows[URL]' target='_blank'>$rows[Caption]</a>";

          if($_SESSION['id'] == $_GET['id']){
            echo "<button class='btn btn-danger' id='Remove' style='float: right;' value='$rows[URL]' onclick='removeFile()'>Ta bort</button><br><br></li>";
          }

        	
        	}
        
echo "</ul>";
     }else{
     	echo "<p>Det finns inga filer att visa.</p>";
     }
        ?>


        </div>
        </div>
        <div class="col-md-6">
        	
<div class="jumbotron">
<?php if($_SESSION['id'] == $_GET['id']){ ?>
<input type="image" src="images/changetext.png" width="50" height="50"  data-toggle="modal" data-target="#changepost">

<?php
}
 $res = opendb("", "CALL read_company_posts('$_GET[id]')");


 if($res[0] == 1){

 while($row = $res[1]->fetch_assoc()){    
 ShowModal($row['Caption'], $row['Message']);
   echo <<<POST
	<h3><b>$row[Caption]</b></h3>
	<p>$row[Message]</p>
	<br>
	<small>Skrivet $row[Posted]</small>
POST;

 }
 }else{
     echo "Det gick inte.";
 }
?>  
</div>
    </div>
 

          <h4>Erbjudandesektionen är inte tillgänglig för tillfället. Den låses upp när hela appen släpps.</h4>


        
        </div>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Nozia Advertising Ltd 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
	</div>
</div>

    <!-- /.container -->

    <!-- jQuery -->
    

</body>
<div id="changebanner" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Byt företagets banderoll.</h4>
      </div>
      <div class="modal-body">

      <p>Rekommenderad bildstorlek är <b>1420x200pixlar.</b></p>
      <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>" enctype="multipart/form-data">

     <label>Välj bild:</label>
     <input type="file" name="bannerfile" id="bannerfile">
  <br>
     <input type="submit" name="newbanner" class="btn btn-success" value="Ladda upp">

     </form>
    </div>

  </div>
   

  </div>
  </div>
</div>

</html>
<?php
}
}
}




//Ifall företaget inte finns
if($hej != true){
    ?>
   <!DOCTYPE html>
<html>
<head>
<script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
    <title>Error(404)</title>
</head>
<body>

<h2>Error (404) Företagssidan kunde inte hittas <a href="../categories">Välj kategori</a></h2>
</body>
</body>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>

 <?php   
}




?>



