<div id="HandleOffers" class="modal fade" role="dialog">

<script type="text/javascript" src="ajax/RemoveOffer.js"></script>
<script type="text/javascript" src="Scripts/js/script.js"></script>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hantera erbjudanden (Lämna fältet ålder tomt ifall du inte vill ha någon gräns.)</h4>
      </div>
      <div class="modal-body">
     <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addoffer">Lägg till</button>
     <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showoffers">Visa erbjudanden</button>

     <div id="addoffer" hidden>
       
     <form method="POST" action="index.php?id=<?php echo $_SESSION['id'];  ?>" id="Addofferform" enctype="multipart/form-data">
         <label>Rubrik:</label>
          <input type="text" class="form-control" name="Caption">

         <label>Beskrivning:</label>
         <textarea class="form-control" name="Description"></textarea>


         <div class="col-md-6">
            <label>Startdatum:</label>
            <input type="text" class="form-control" name="Startdate">
         </div>

         <div class="col-md-6">
            <label>Slutdatum:</label>
            <input type="text" class="form-control" name="Duedate">

         </div>


           <div class="col-md-6">

            <label>Från ålder:</label>
            <input type="text" class="form-control" name="FromAge">

         </div>

           <div class="col-md-6">
            <label>Till ålder:</label>
            <input type="text" class="form-control" name="ToAge">
  <br>
         </div>

              <div class="col-md-6">
            <label>Kommuner</label>

            <div id="CSList" style="overflow-y: scroll; height: 100px;">
           
            <?php
             list($num_rows, $result) = opendb("", "CALL read_CS()");



             if($num_rows != 0){
             	while($rows = $result->fetch_assoc()){

             		if($rows['ID'] == $_SESSION['citystate']){
                    
                    echo "<input type='checkbox' checked name='CS[]' value= '". $rows['ID'] ."'> " . $rows['CityState']. "<br>";

             		}else{
             			echo "<input type='checkbox' name='CS[]' value= '". $rows['ID'] ."'> " . $rows['CityState']. "<br>";
             		}

             		


             	}
             }

            ?>
                      
           
  <br>
  <br>
         </div>
         </div>

         <div class="col-md-6">
         <label>Välj kön:</label>
         <br>
         <br>
            <select name="Gender" class="form-control">
                 <option value="1">Män</option>    
                 <option value="2">Kvinnor</option>
                 <option value="3">Båda</option>          	
            </select>
         </div>
    <br>

         <input type="file" name="OfferFile">
<br>

         <input type="submit" name="NewOffersubmit" class="btn btn-success" value="Spara">

     </form>

     </div>

        <div id="showoffers" hidden>
       
       <table class="table table-bordered">
    <thead>
      <tr>
        <th>Rubrik</th>
        <th>Ta bort</th>
      </tr>
    </thead>
    <tbody>
      

      <?php
         list($num_rows, $result) = opendb("", "CALL read_offers('$_SESSION[id]')");

         while($rows = $result->fetch_assoc()){
      ?>
      <tr id="tr<?php echo $rows[ID] ?>">
        <td><?php echo $rows['Caption']; ?></td>
        <td>
            <button value="<?php echo $rows[ID] ?>" class="btn btn-danger" onclick="Check(this.value)">Ta bort</button>
        </td>
        </tr>

         <?php
             }
         ?>
      
     
    </tbody>
  </table>

     </div>

      
      </div>
      <div class="modal-footer">
       
      </div>
    </div>


  </div>
</div>
