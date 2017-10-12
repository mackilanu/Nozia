<?php
session_start();


//Läser in informationen och lägger dess värde som default i madalen.
 list($num_rows, $result_info) = opendb("", "CALL read_Foretagssida('$_SESSION[id]')");

    while($info = $result_info->fetch_assoc()){
      $telefon = $info['Telefon'];
      $postnr = $info['Postnr'];
      $adress = $info['Adress'];
    }


if(isset($_POST['phone'])){

  $phone  = $_POST['phone'];
  $adress = $_POST['adress'];
  $email  = $_POST['email'];
  $id     = $_SESSION['id'];

     //Uppdaterar informationen Telefon, Adress och postnr, email för företaget.
     list($num_rows, $result) = opendb("", "CALL  update_foretagssida('$phone', '$adress', '$email', '$id')");

         if($num_rows != 0){
             header("Location: index.php?id=$_SESSION[id]");
             echo "Ditt företags kontaktuppgifter är nu uppdaterade!";
         }
         else{
              echo "Ditt företags kontaktuppgifter gick inte att uppdatrera pågrund av ett oföruttsett fel. Kontakta administratör om problemet kvarstår.";
             
   }
  }



?>
<div id="changeInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ändra företagets uppgifter</h4>
      </div>
      <div class="modal-body">
      <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>">

     <label>Telefonnummer:</label>
     <input type="text" class="form-control" value="<?php echo $telefon; ?>" name="phone" >

     <label>Adress:</label>
     <input type="text" class="form-control" name="adress" value="<?php echo $adress; ?>" ><br>

     <label>Postnummer/Email</label>
     <input type="text" class="form-control"  name="email" value="<?php echo $postnr; ?>" ><br>

      <input type="submit" class="btn btn-success" value="Spara">

     </form>
    </div>

  </div>
   

  </div>
  </div>
  