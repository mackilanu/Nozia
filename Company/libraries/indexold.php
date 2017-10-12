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

//H�mtar datan fr�n tabellen Companies
while($rows = $result[1]->fetch_assoc())
{

    

//Om URL-parametern st�mmer �verenns med f�retagets id s� k�rs detta
if($_GET['id'] == $rows['ID'])
{

    
 $res_foretag = opendb("", "CALL read_Foretagssida('$_GET[id]')");


    while($rows_foretag = $res_foretag[1]->fetch_assoc()){

        $hej = true;


     
        
        //Och om  URL-parametern st�mer �verenns med f�retagets ID, s� k�ra sidan.
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
       
    <title><?php echo $rows['Name'];?> -Företagssida</title>

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
 require_once("../includes/navbar.php");
  require_once("Scripts/changePostModal.php");
  require_once("Scripts/changeInfoModal.php");
  require_once("Scripts/UpdateLogo.php");
  require_once("Scripts/AddFile.php");
  require_once("Scripts/ChangeBackground.php");
  require_once("Scripts/HandleOffers.php");
  require_once("Scripts/PostOffer.php");


?>


  
<!-- Ska bara finnas om sessionsvariabel f�r CompanyUser finns, och som st�mmer �verenns med f�retagets ID. -->
    <!-- Page Content -->

    <div class="container" style="margin-top: 50px;">
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
    
    
if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){

      require_once("Scripts/post_newOffer.php");
     echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#changebanner">Byt banner</button>';
     echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Changebackground">Byt Bakgrund</button>';
   
 }


         
?>


  <div style="background-color: #FFF" class="jumbotron">
<div class="jumbotron jumbotron-style center img-responsive" style="background: url(<?php echo $rows_foretag['Banner']; ?>);    width: 100%; height: 200px; background-repeat: no-repeat; background-size: auto;
    position: relative; 
 ;"></div>


<div class="col-md-4">

               <h4 style=""><span class="glyphicon glyphicon-earphone" style="margin-right: 5px;"></span><?php echo $rows_foretag['Telefon']; ?></h4>

            </div>

            <div class="col-md-4">
               <h4><span class="glyphicon glyphicon-home" style="margin-right: 5px;"></span><?php echo $rows_foretag['Adress']; ?> </h4>
              
            </div>

            <div class="col-md-4">
             <h4><span class="glyphicon glyphicon-pencil"></span> <?php echo $rows_foretag['Postnr']; ?></h4>
        
            </div>
            <?php if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){ ?>
          <input type="submit" class="btn btn-success" value="Ändra uppgifter" data-toggle="modal" data-target="#changeInfo">

         <?php } ?>
        <!-- Portfolio Item Heading -->
        <div class="row">

            <div class="col-lg-12">
                <h1 style="text-align: center;" class="page-header"><?php echo $_GET['company']; ?>

                                 <?php
                   if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){
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
      
                
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="jumbotron">
            <?php  
            if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){

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

          if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){
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
<?php if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){ ?>
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


 
 <div class="row">
        <div class="col-md-12">
        
        <?php
        if($_SESSION['id']  == $_GET['id'] && $_SESSION['type'] == 1){
              echo '<button class="btn btn-success" data-toggle="modal" data-target="#HandleOffers">Hantera erbjudanden</button>';
      }

        	?>
      
            <div class="jumbotron">

             <h3>Senaste erbjudandet</h3>

             <?php
             
             //R�knar ut �ldern p� ancv�ndaren
       
              $date = getdate();
              $day   = $date['mday'];
              $month = $date['mon'];
              $year  = $date['year'];

                
                list($yearUser,$monthUser,$dayUser)=explode("-", $_SESSION['birthday']);


               $age = $year - $yearUser;

              if($monthUser > $month){

                   $age = $age - 1;
               }

              if($monthUser == $month && $dayUser < $day){

                       $age = $age -1;
              }

       


                    
                list($num_rows, $result)               = opendb("", "CALL read_latestoffer('$_GET[id]')");

                if($num_rows == 0 or !$result){

                	echo "Det finns inga erbjudanden.";
                }else{

                	while($rows = $result->fetch_assoc()){

                    if($_SESSION['type'] == 1 && $_SESSION['id'] == $_GET['id'] ){

                     echo <<<LATEST
                   
                   <img src="$rows[Image]"><br>
                   <p><a href="/erbjudande/?offer=$rows[ID]&id=$_GET[id]">$rows[Caption]</a></P>
                   <small><b>Utgår $rows[DueDate]<b></small>

LATEST;


                    }

                    if($age >= $rows['MinAge']){

                      if($age <= $rows['MaxAge']){

                        if($_SESSION['Gender'] == $rows['Gender'] || $rows['Gender'] == 3){

                  	echo <<<LATEST
                                      
                    <img width="500" height="300" src="$rows[Image]"><br>
                    <p><a href="/erbjudande/?offer=$rows[ID]&id=$_GET[id]">$rows[Caption]</a></P>
                    <small><b>Utgår $rows[DueDate]<b></small>

LATEST;

}
}
}
}


}
              

             ?>

 </div>
 </div>
 </div>


  <div class="row">
        <div class="col-md-6">
            <div class="jumbotron">

             <h3>Andra erbjudanden</h3>


              <?php
                list($num_rows, $result) = opendb("", "CALL read_offers('$_GET[id]')");

                if($num_rows == 0 or !$result){

                	echo "<p>Det finns inga erbjudanden.</p>";
                }else{
                 echo "<ul>";
                	while($rows = $result->fetch_assoc()){

                                   if($_SESSION['type'] == 1 && $_SESSION['id'] == $_GET['id']){


                                          echo <<<LATEST
                     <li><a href="/erbjudande/?offer=$rows[ID]&id=$_GET[id]">$rows[Caption]</a></li>
                   
                

LATEST;
                    }
                    if($age >= $rows['MinAge']){

                      if($age <= $rows['MaxAge']){


                    if($_SESSION['Gender'] == $rows['Gender'] || $rows['Gender'] == 3 || $_SESSION['type'] == 1 && $_SESSION['id'] == $_GET['id']){
                   echo <<<LATEST
                
                   <li><a href="/erbjudande/?offer=$rows[ID]&id=$_GET[id]">$rows[Caption]</a></li>
LATEST;
  }
}
}
}


            echo "</ul>";
                }

             ?>
 </div>
 </div>
 </div>      
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

    <!-- /.container -->

    <!-- jQuery -->
    

</body>
<div id="changebanner" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Byt f�retagets banderoll.</h4>
      </div>
      <div class="modal-body">

      <p>Rekommenderad bildstorlek �r <b>1420x200pixlar.</b></p>
      <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>" enctype="multipart/form-data">

     <label>V�lj bild:</label>
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

//Ifall f�retaget inte finns
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

<h2>Error (404) F�retagssidan kunde inte hittas <a href="../categories">V�lj kategori</a></h2>
</body>
</body>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>

 <?php   
}




?>



