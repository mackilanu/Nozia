
<?php

if(isset($_POST['submitChangeLogo'])){

	
    $result = opendb("", "CALL read_Foretagssida('$_GET[id]')");

     $row = $result[1]->fetch_assoc();
     if (file_exists($row['Icon'])) {
           unlink($row['Icon']);
       } else { 
           echo "Filen kunde inte hittas.";
       }
require_once("Scripts/uploadfile.php"); 
     $id  = $_SESSION['id'];
    $file = uploadfile("images/", "IconFile", "Din ikon är nu upplagd!");
    $res  = opendb("", "CALL update_CompanyIcon('$file', '$id')");

}
 
?>

<div id="changeLogo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Byt logga</h4>
      </div>
      <div class="modal-body">

      <p>Rekommenderad bildstorlek är <b>150x150 pixlar.</b></p>
      <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>" enctype="multipart/form-data">

     <label>Välj bild:</label>
     <input type="file" name="IconFile" accept="image/*">
  <br>
     <input type="submit" name="submitChangeLogo" class="btn btn-success" value="Ladda upp">

     </form>
    </div>

  </div>
   

  </div>
  </div>