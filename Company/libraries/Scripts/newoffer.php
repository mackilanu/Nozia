


<form action="index.php?id=<?php echo $_GET['id']; ?>" method="POST">
<div id="addoffer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lägg till ett erbjudande</h4>
      </div>
      <div class="modal-body">
     <div class="form-group">
         <div class="col-md-12">
         <label>Namn:</label>
         <input type="text" class="form-control" name="name">
         <br>
         <label>Beskrivning:</label>
         <textarea class="form-control" name="description"></textarea>
     </div>
     </div>
    <br>
    <!-- Startdatum för erbjudandet -->
     <div class="col-md-6" style="margin-top: 20px;">
     <label>Startdatum:</label>
      <div class="input-group date" data-provide="datepicker">
       
    <input type="text" class="form-control" name="date1" placeholder="ååååmmdd">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
     </div>
     <!-- Slutdatum för erbjudandet -->
      <div class="col-md-6" style="margin-top: 20px;">
        <label>Slutdatum:</label>
      <div class="input-group date" data-provide="datepicker">
    <input type="text" class="form-control" name="date2" placeholder="ååååmmdd">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
     </div>
     
     
            <label class="btn btn-default btn-file">
           Välj bild <input type="file" name="offerimage[]" id="file">
</label>

 <div class="col-md-12" style="margin-top: 15px">
  <input type="submit" class="btn btn-success" name="submit_newOffer" value="Lägg upp">
</div>

      
      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
</form>