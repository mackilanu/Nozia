<div class="col-md-12" id="main">
	<h1 style="color: #000; text-align: center;">Release notes</h1>
     
     <?php if($_SESSION['id'] == 116){ ?>
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Lägg till</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lägg till patch note</h4>
      </div>
      <div class="modal-body">
        <label>Rubrik:</label>
        <input type="text" id="Caption" class="form-control">

        <label>Meddelande</label>
        <textarea class="form-control" id="Message" rows="4"></textarea>

        <label>Datum</label>
        <input type="text" id="Date" class="form-control">

        <label>Version</label>
        <input type="text" id="Version" class="form-control">
        <br>
        <button class="btn btn-success" id="upload_note" onclick="Upload()">Ladda upp</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>



</div>

<?php } ?>

</div>