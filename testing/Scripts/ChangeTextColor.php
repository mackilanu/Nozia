<?php
     
  if(isset($_POST['submitChangeColor'])){
session_start();
   
    require_once("../includes/fileupload.php"); 

    $caption = $_POST['Caption'];
     $id  = $_SESSION['id'];
   $color = $_POST['color'];
    list($num_rows, $result) = opendb("", "CALL update_TextColor('#$color', '$_GET[id]')");

    if($num_rows == 0 or !$result){
      echo "Det gick inte att lägga till bilden. Kontakta administratör om problemet kvarstår.";
    }

  }

?>


<div id="ChangeTextColor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ändra färg på texten.</h4>
      </div>
      <div class="modal-body">


      <form method="POST" action="index.php?id=<?php echo $_GET['id'];  ?>" enctype="multipart/form-data">

         
     <label>Välj färg i hexkod:</label>
<div class="inner-addon left-addon">

    <input type="text" class="form-control" name"color" style="width: 30%;">
</div>
<br>
     <input type="submit" name="submitChangeColor" class="btn btn-success" value="Ändra">

     </form>
    </div>

  </div>
   

  </div>
  </div>