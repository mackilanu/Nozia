<?php
session_start();
require_once("../includes/config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

 <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <script type="text/javascript" src="../css/jquery-3.2.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
   <!--  <script type="text/javascript" src="ajax/categories.js"></script> -->
    <title>Nozia -Slogan</title>

    
          

</head>

 <body>
<?php


$CS = $_GET['CS'];
 ?>

  <?php require_once("../includes/navbar.php");
        
    ?> 

    <div class="container">

        <div class="row" style="margin-top: 80px;">
            <div class="col-lg-6 col-xs-6">

                <h2>Kategorier</h2>
            </div>
            
            <div class="col-lg-6 col-xs-6">
                <div class="form-group ChooseCS">
					<label for="sel1">Välj Kommun</label>
          <form method="GET" action="index.php?CS=<?php echo $CS?>">
            <select class="form-control" id="citystate" onchange="newUrl()" name="CS">

            <?php require_once("ajax/fetch_CS.php"); ?>
            	
            </select>

            <input type="submit" class="btn btn-success" value="Sök" name="submitChangeCS">
				

					</form>
				</div>
         
    		</div>

         
               
  	<div id="categories">
  	<?php
    require_once("ajax/fetch_categories.php");
    ?>
  	</div>
</div>
   <hr>
    </div>

    
</body>
</html>
