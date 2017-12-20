<?php
     
  if(isset($_POST['submitChangeBackground'])){
session_start();
   
    require_once("../includes/fileupload.php"); 

    $caption = $_POST['Caption'];
     $id  = $_SESSION['id'];
    $file = uploadfile("images/", "UploadNewBackground", "Din bakgrundsbild är nu upplagd!");
    list($num_rows, $result) = opendb("", "CALL update_CompanyBackground('$file', '$_GET[id]')");

    if($num_rows == 0 or !$result){
      echo "Det gick inte att lägga till bilden. Kontakta administratör om problemet kvarstår.";
    }

  }

?>


<div id="Changebackground" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ändra bakgrundsbild.</h4>
      </div>
      <div class="modal-body">

      <p>Rekommenderad bildstorlek är <b>1920x1080 pixlar.</b> filen ska vara i PDF-format</p>
      <form method="POST" action="index.php?id=<?php echo $_GET['id'];  ?>" enctype="multipart/form-data">

         
     <label>Välj bild:</label>
     <input type="file" name="UploadNewBackground">
  <br>

     <input type="submit" name="submitChangeBackground" class="btn btn-success" value="Ladda upp">

     </form>
    </div>

  </div>
   

  </div>
  </div>