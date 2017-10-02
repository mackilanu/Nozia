<?php
  
  if(isset($_POST['submitUploadCatalog'])){
session_start();
   
  	require_once("../includes/fileupload.php"); 

    $caption = $_POST['Caption'];
    $id  = $_SESSION['id'];
    $file = uploadfile("files/", "UploadCatalogFile", "Din fil är nu upplagd!");
    $res  = opendb("", "CALL insert_Company_file('$_GET[id]', '$file', '', '$caption')");


  }

?>
  

<div id="AddFile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lägg upp en katalog/fil</h4>
      </div>
      <div class="modal-body">

      <p>Rekommenderad bildstorlek är <b>250x250 pixlar.</b> filen ska vara i PDF-format</p>
      <form method="POST" action="index.php?id=<?php echo $_GET['id'];  ?>" enctype="multipart/form-data">

          <label>Rubrik:</label>
     <input type="text" class="form-control" name="Caption">
  <br>

     <label>Välj katalog:</label>
     <input type="file" name="UploadCatalogFile">
  <br>

     <input type="submit" name="submitUploadCatalog" class="btn btn-success" value="Ladda upp">

     </form>
    </div>

  </div>
   

  </div>
  </div>


