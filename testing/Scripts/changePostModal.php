<?php
session_start();

if(isset($_POST['caption'])){
  $rubrik     = $_POST['caption'];
  $meddelande = $_POST['message'];
  $ID         = $_SESSION['id'];

 list($num_rows, $result) =  opendb("", "CALL update_company_post('$rubrik', '$meddelande', '$ID' )");

 if( $num_rows == 1){
  echo "Din status är nu uppdaterad!";
 }else{
   echo "Ett probblem med att uppdatera statusen har inträffat, om problemet kvarstår kontakta en administratör.";
  echo $rubrik . " ". $meddelande;
   echo $_SESSION['id'];
 }

}


function ShowModal($caption, $message){
?>
<div id="changepost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ändra din text</h4>
      </div>
      <div class="modal-body">
      <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>">
     <label>Rubrik:</label>
     <input type="text" class="form-control" name="caption" >
     <label>Meddelande:</label>
     <textarea class="form-control" rows="5" name="message"></textarea><br>
      <input type="submit" class="btn btn-success" value="Spara">

     </form>
    </div>

  </div>
   

  </div>
  </div>
  

  <?php
}

  ?>
