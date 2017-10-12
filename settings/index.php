<!DOCTYPE html>
<html>
<head>
	<title>NOZIA - Ändra dina uppgifter</title>
	 <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <script type="text/javascript" src="../css/jquery-3.2.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	

</head>
<body>
<?php
require_once("../includes/navbar.php");
require_once("../MySQL/DBconnect.php");


$username = $_SESSION['username'];
$password = $_SESSION['password'];
$CS       = $_SESSION['citystate'];
$Fname    = $_SESSION['firstname'];
$email    = $_SESSION['email'];
$Bday     = $_SESSION['birthday'];
$verified = $_SESSION['verified'];
$gender   = $_SESSION['Gender'];
?>

<div class="container">
	<div class="row">

	<div class="col-md-2 col-xs-0"></div>

	<div class="col-md-8 col-xs-12">

		<div class="form-group">
		  <label for="Username">Användarnamn:</label>
		  <input type="text" name="Username" class="form-control" disabled value="<?php echo $username;  ?>">
        </div>


		<div class="form-group">
	
		  <label for="CS">Kommun:</label>
		  <select disabled name="CS" id="citystate"  class="form-control">

		  <?php
		       list($num_rowsCS, $resultCS) = opendb("", "CALL read_CS()");

			   while($rowsCS = $resultCS->fetch_assoc()){

				   if($rowsCS['ID'] == $_SESSION['citystate']){
					   echo '<option selected value="'. $rowsCS['ID']  .'">'. $rowsCS['CityState'] .'</option>';
				   }else{
					   echo '<option value="'. $rowsCS['ID']  .'">'. $rowsCS['CityState'] .'</option>'; 
				   }
			   }
		  ?>
		  
		  </select>
        </div>

		<div class="form-group">
		  <label for="Username">Förnamn:</label>
		  <input type="text" name="Fname" class="form-control" disabled value="<?php echo $Fname;  ?>">
        </div>

		<div class="form-group">
		  <label for="Username">Email:</label>
		  <input type="text" name="email" class="form-control" disabled value="<?php echo $email;  ?>">
        </div>		

		<div class="form-group">
		  <label for="Username">Födelsedag:</label>
		  <input type="text" name="birthday" class="form-control" disabled value="<?php echo $Bday;  ?>">
        </div>

		<div class="form-group">
		  <label for="Username">Veriefierad:</label>
		  <?php

		  if($verified == 0){
			  echo '<p>Nej</p>';
		  }
		  if($verified == 1){
			  echo '<p>Ja</p>';		  
		  }
		  ?>
        </div>		

		<div class="form-group">
		  <label for="Username">Kön:</label>
	      <?php

		  if($gender == 1){
			   echo '<p>Man</p>';
		  }
		  if($gender == 2){
			   echo '<p>Kvinna</p>';
		  }

		  if($gender == 3){
			   echo '<p>Övrigt</p>';
		  }

		  ?>
        </div>						


	<div class="col-md-2 col-xs-0"></div>
		</div>

	</div>

</div>
</body>
</html>